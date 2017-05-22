Ext.override(Ext.data.Store, {

	/**
	 * Runs the aggregate function for all the records in the store.
	 *
	 * When store is filtered, only items within the filter are aggregated.
	 *
	 * @param {Function} fn The function to execute. The function is called with a single parameter,
	 * an array of records for that group.
	 * @param {Object} [scope] The scope to execute the function in. Defaults to the store.
	 * @param {Boolean} [grouped] True to perform the operation for each group
	 * in the store. The value returned will be an object literal with the key being the group
	 * name and the group average being the value. The grouped parameter is only honored if
	 * the store has a groupField.
	 * @param {Array} [args] Any arguments to append to the function call
	 * @return {Object} An object literal with the group names and their appropriate values.
	 */
	aggregate: function(fn, scope, grouped, args) {
		args = args || [];
		if (grouped && this.isGrouped()) {
			var groups = this.getGroupData(false),
				i = 0,
				len = groups.length,
				out = {},
				group;

			for (; i < len; ++i) {
				group = groups[i];
				this.aggregateGroup(out, fn, scope, group, args);
			}
			return out;
		} else {
			return fn.apply(scope || this, [this.data.items].concat(args));
		}
	},

	aggregateGroup: function(out, fn, scope, group, args) {
		if (group.children) {
			for (var c = group.children.length - 1; c >= 0; c--) {
				child = group.children[c];
				child.parent = group.name;
				child.name = group.name + '' + child.name;
				this.aggregateGroup(out, fn, scope, child, args);
			}
		}
		out[group.name] = fn.apply(scope || this, [group.records].concat(args, group.depth));
	}
	

	
});

Ext.override(Ext.grid.feature.AbstractSummary, {

	/**
	 * Gets the value for the column from the attached data.
	 * @param {Ext.grid.column.Column} column The header
	 * @param {Object} data The current data
	 * @return {String} The value to be rendered
	 */
	getColumnValue: function(column, summaryData){
		var comp	 = Ext.getCmp(column.id),
			value	= summaryData[column.id],
			renderer = comp.summaryRenderer;

		if (renderer) {
			value = renderer.call(
				comp.scope || this,
				value,
				summaryData,
				column.dataIndex
			);
		}

		if (!value && value !== 0) {
			value = '\u00a0';
		}
		return value;
	},

	/**
	 * Get the summary data for a field.
	 * @private
	 * @param {Ext.data.Store} store The store to get the data from
	 * @param {String/Function} type The type of aggregation. If a function is specified it will
	 * be passed to the stores aggregate function.
	 * @param {String} field The field to aggregate on
	 * @param {Boolean} group True to aggregate in grouped mode 
	 * @return {Number/String/Object} See the return type for the store functions.
	 */
	getSummary: function(store, type, field, group){
		if (type) {
			if (Ext.isFunction(type)) {
				return store.aggregate(type, null, group, [field]);
			}

			switch (type) {
				case 'count':
					return store.count(group);
				case 'min':
					return store.min(field, group);
				case 'max':
					return store.max(field, group);
				case 'sum':
					return store.sum(field, group);
				case 'average':
					return store.average(field, group);
				default:
					return group ? {} : '';
					
			}
		}
	}
});


Ext.override(Ext.panel.Table, {
    onVerticalScroll: function (event, target) {
        var owner = this.getScrollerOwner(),
            items = owner.query('tableview'),
            i = 0,
            len = items.length;

        for (; i < len; i++) {
            items[i].el.dom.scrollTop = target.scrollTop;
        }
        // fix for scrolling
        var dom = owner.view.el.dom
        var totalsummary = dom.lastChild;
        if (totalsummary.summary === "") {
            var top = dom.clientHeight - dom.scrollHeight + dom.scrollTop + (dom.clientHeight == dom.scrollHeight ? owner.view.Top : 0)
            totalsummary.style.top = top + 'px'
            owner.view.Top = 0
        }
    },
});

Ext.override(Ext.view.Table, {
    onHeaderResize: function (header, w, suppressFocus) {
        var me = this,
            el = me.el;
        if (el) {
            me.saveScrollState();
            if (Ext.isIE6 || Ext.isIE7) {
                if (header.el.hasCls(Ext.baseCSSPrefix + 'column-header-first')) {
                    w += 1;
                }
            }
            el.select('.' + Ext.baseCSSPrefix + 'grid-col-resizer-' + header.id).setWidth(w);
            el.select('.' + Ext.baseCSSPrefix + 'grid-table-resizer').setWidth(me.headerCt.getFullWidth());
            me.restoreScrollState();
            if (!me.ignoreTemplate) {
                me.setNewTemplate();
            }
            if (!suppressFocus) {
                me.el.focus();
            }
            if (header.flex) { //fix for flex columns
                ownerHeaderCt = header.getOwnerHeaderCt();
                ownerHeaderCt.fireEvent('columnresize', ownerHeaderCt, header, w);
            }
        }
    },
    focusRow: function (rowIdx) {
        var me = this,
            row = me.getNode(rowIdx),
            el = me.el,
            adjustment = 0,
            panel = me.ownerCt,
            rowRegion, elRegion, record;

        if (row && el) {
            elRegion = el.getRegion();
            rowRegion = Ext.fly(row).getRegion();

            if (rowRegion.top < elRegion.top) {
                adjustment = rowRegion.top - elRegion.top;

            } else if (rowRegion.bottom > elRegion.bottom) {
                adjustment = rowRegion.bottom - elRegion.bottom;
            }
            record = me.getRecord(row);
            rowIdx = me.store.indexOf(record);

            if (adjustment) {
                if (me.fixedSummaryRow) adjustment += me.fixedSummaryRow.offsetHeight //fix
                panel.scrollByDeltaY(adjustment);
            }
            me.fireEvent('rowfocus', record, row, rowIdx);
        }
    }
});

if (document.getElementsByClassName) {

    getElementsByClass = function (classList, node) {
        return (node || document).getElementsByClassName(classList)
    }

} else {

    getElementsByClass = function (classList, node) {
        var node = node || document,
            list = node.getElementsByTagName('*'),
            length = list.length,
            classArray = classList.split(/\s+/),
            classes = classArray.length,
            result = [],
            i, j
        for (i = 0; i < length; i++) {
            for (j = 0; j < classes; j++) {
                if (list[i].className.search('\\b' + classArray[j] + '\\b') != -1) {
                    result.push(list[i])
                    break
                }
            }
        }

        return result
    }
}