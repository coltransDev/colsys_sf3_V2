<style type="text/css">
<!--
/* begin some basic styling here */
body {
background: #FFF;
color: #000;
font: normal normal 10px Verdana, Geneva, Arial, Helvetica, sans-serif;
margin: 0px;
padding: 0
}
table, td, a {
color: #000;
font: normal normal 10px Verdana, Geneva, Arial, Helvetica, sans-serif
}
div#tbl-container {
width: 750px;
height: 530px;
overflow: auto;
scrollbar-base-color:#C9C299;
}
div#tbl-container tr.normalRow td {
background: #fff;
padding: 4px 4px 4px 4px;
font-size: 10px;
}
div#tbl-container tr.alternateRow td {
background: #AFDCEC;
padding: 4px 4px 4px 4px;
font-size: 10px;
}
div#tbl-container table {
table-layout: fixed;
border-collapse: collapse;
background-color: WhiteSmoke;
}
div#tbl-container table th {
width: 100px;
}
div#tbl-container thead th, div#tbl-container thead th.locked {
font-size: 10px;
font-weight: bold;
text-align: center;
background-color: #2B3856;
color: white;
position:relative;
cursor: default;
}

div#tbl-container thead th {
top: expression(document.getElementById("tbl-container").scrollTop-2); /* IE5+ only */
z-index: 20;
}
div#tbl-container thead th.locked {z-index: 30;}
div#tbl-container td.locked, div#tbl-container th.locked{
background-color: #ffeaff;
font-weight: bold;
left: expression(document.getElementById("tbl-container").scrollLeft); /* IE5+ only */
position: relative;
z-index: 10;
}
-->
</style>
************************************************** ****

Following is my html code:
###########################################


<div id="tbl-container">
<table id="tbl">
<thead class="fixedHeader">
<tr>
<th class="locked">Location</th>
<th class="locked">Product Line</th>
<th>POS(MTD)</th>
<th>Onhand Stock</th>
<th>Intransit Stock</th>
<th>Delinquent SO</th>
<th>Current Open SO</th>
<th>Current Scheduled SO</th>
<th>Delinquent PO</th>
<th>Current Open PO
<th>Current Scheduled PO</th>
<th>Current Expected Stock</th>
<th>Next Open SO</th>
<th>Next Scheduled SO</th>
<th>Next Open PO</th>
<th>Next Scheduled PO</th>
<th>Next Expected Stock</th>
<th>2nd Next Open SO</th>
<th>2nd Next Scheduled SO</th>
<th>2nd Next Open PO</th>
<th>2nd Next Scheduled PO</th>
<th>2nd Next Expected Stock</th>
</tr>
</thead>

<tbody>

<tr class="alternateRow">
<td align=left style="background:#C9C299" class="locked">CHK</td>
<td align=right style="background:#C9C299" class="locked">1</td>
<td align=right>0.00</td>
<td align=right>10,146,396.43</td>
<td align=right>1,548.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>21,886,146.45</td>
<td align=right>560,189.00</td>
<td align=right>0.00</td>
<td align=right>10,147,944.43</td>
<td align=right style="background:#F9B7FF;">0.00</td>
<td align=right style="background:#F9B7FF;">0.00</td>
<td align=right style="background:#F9B7FF;">0.00</td>
<td align=right style="background:#F9B7FF;">0.00</td>
<td align=right style="background:#F9B7FF;">10,147,944.43</td>
<td align=right style="background:#B5EAAA;">0.00</td>
<td align=right style="background:#B5EAAA;">0.00</td>
<td align=right style="background:#B5EAAA;">0.00</td>
<td align=right style="background:#B5EAAA;">0.00</td>
<td align=right style="background:#B5EAAA;">10,147,944.43</td>
</tr>


<tr class="normalRow">
<td align=left class="locked">CHK</td>
<td align=right class="locked">2</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
</tr>

<tr class="alternateRow">
<td align=left style="background:#C9C299" class="locked">CHK</td>
<td align=right style="background:#C9C299" class="locked">2</td>
<td align=right>0.00</td>
<td align=right>0.95</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>5,070.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.95</td>
<td align=right style="background:#F9B7FF;">0.00</td>
<td align=right style="background:#F9B7FF;">0.00</td>
<td align=right style="background:#F9B7FF;">0.00</td>
<td align=right style="background:#F9B7FF;">0.00</td>
<td align=right style="background:#F9B7FF;">0.95</td>
<td align=right style="background:#B5EAAA;">0.00</td>
<td align=right style="background:#B5EAAA;">0.00</td>
<td align=right style="background:#B5EAAA;">0.00</td>
<td align=right style="background:#B5EAAA;">0.00</td>
<td align=right style="background:#B5EAAA;">0.95</td>
</tr>


<tr class="normalRow">
<td align=left class="locked">CHK</td>
<td align=right class="locked">3</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
</tr>

<tr class="alternateRow">
<td align=left style="background:#C9C299" class="locked">CHK</td>
<td align=right style="background:#C9C299" class="locked">3</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right style="background:#F9B7FF;">0.00</td>
<td align=right style="background:#F9B7FF;">0.00</td>
<td align=right style="background:#F9B7FF;">0.00</td>
<td align=right style="background:#F9B7FF;">0.00</td>
<td align=right style="background:#F9B7FF;">0.00</td>
<td align=right style="background:#B5EAAA;">0.00</td>
<td align=right style="background:#B5EAAA;">0.00</td>
<td align=right style="background:#B5EAAA;">0.00</td>
<td align=right style="background:#B5EAAA;">0.00</td>
<td align=right style="background:#B5EAAA;">0.00</td>
</tr>


<tr class="alternateRow">
<td align=left style="background:#C9C299" class="locked">CHK</td>
<td align=right style="background:#C9C299" class="locked">0</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right style="background:#F9B7FF;">0.00</td>
<td align=right style="background:#F9B7FF;">0.00</td>
<td align=right style="background:#F9B7FF;">0.00</td>
<td align=right style="background:#F9B7FF;">0.00</td>
<td align=right style="background:#F9B7FF;">0.00</td>
<td align=right style="background:#B5EAAA;">0.00</td>
<td align=right style="background:#B5EAAA;">0.00</td>
<td align=right style="background:#B5EAAA;">0.00</td>
<td align=right style="background:#B5EAAA;">0.00</td>
<td align=right style="background:#B5EAAA;">0.00</td>
</tr>
<tr class="normalRow">
<td align=left class="locked">CHK</td>
<td align=right class="locked">J</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
</tr>

<tr class="alternateRow">
<td align=left style="background:#C9C299" class="locked">CHK</td>
<td align=right style="background:#C9C299" class="locked">K</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right style="background:#F9B7FF;">0.00</td>
<td align=right style="background:#F9B7FF;">0.00</td>
<td align=right style="background:#F9B7FF;">0.00</td>
<td align=right style="background:#F9B7FF;">0.00</td>
<td align=right style="background:#F9B7FF;">0.00</td>
<td align=right style="background:#B5EAAA;">0.00</td>
<td align=right style="background:#B5EAAA;">0.00</td>
<td align=right style="background:#B5EAAA;">0.00</td>
<td align=right style="background:#B5EAAA;">0.00</td>
<td align=right style="background:#B5EAAA;">0.00</td>
</tr>


<tr class="normalRow">
<td align=left class="locked">CHK</td>
<td align=right class="locked">L</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
</tr>

<tr class="alternateRow">
<td align=left style="background:#C9C299" class="locked">CHK</td>
<td align=right style="background:#C9C299" class="locked">M</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right style="background:#F9B7FF;">0.00</td>
<td align=right style="background:#F9B7FF;">0.00</td>
<td align=right style="background:#F9B7FF;">0.00</td>
<td align=right style="background:#F9B7FF;">0.00</td>
<td align=right style="background:#F9B7FF;">0.00</td>
<td align=right style="background:#B5EAAA;">0.00</td>
<td align=right style="background:#B5EAAA;">0.00</td>
<td align=right style="background:#B5EAAA;">0.00</td>
<td align=right style="background:#B5EAAA;">0.00</td>
<td align=right style="background:#B5EAAA;">0.00</td>
</tr>


<tr class="normalRow">
<td align=left class="locked">CHK</td>
<td align=right class="locked">N</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
</tr>

<tr class="alternateRow">
<td align=left style="background:#C9C299" class="locked">CHK</td>
<td align=right style="background:#C9C299" class="locked">O</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right>0.00</td>
<td align=right style="background:#F9B7FF;">0.00</td>
<td align=right style="background:#F9B7FF;">0.00</td>
<td align=right style="background:#F9B7FF;">0.00</td>
<td align=right style="background:#F9B7FF;">0.00</td>
<td align=right style="background:#F9B7FF;">0.00</td>
<td align=right style="background:#B5EAAA;">0.00</td>
<td align=right style="background:#B5EAAA;">0.00</td>
<td align=right style="background:#B5EAAA;">0.00</td>
<td align=right style="background:#B5EAAA;">0.00</td>
<td align=right style="background:#B5EAAA;">0.00</td>
</tr>
</tbody>
</table>