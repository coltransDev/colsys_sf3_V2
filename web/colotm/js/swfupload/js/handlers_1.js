var j=1000;
function preLoad() {
    alert("preLoad");
	if (!this.support.loading) {
		alert("1. You need the Flash Player to use SWFUpload.");
		return false;
	} else if (!this.support.imageResize) {
		alert("2.You need Flash Player 10 to upload resized images.");
		return false;
	}
}
function loadFailed() {
    alert("loadFailed");
	alert("3.Something went wrong while loading SWFUpload. If this were a real application we'd clean up and then give you an alternative");
}

function fileQueueError(file, errorCode, message) {
    alert("fileQueueError");
	try {
		var imageName = "error.gif";
		var errorName = "";
		if (errorCode === SWFUpload.errorCode_QUEUE_LIMIT_EXCEEDED) {
			errorName = "You have attempted to queue too many files.";
		}

		if (errorName !== "") {
			alert("4."+SWFUpload.errorCode_QUEUE_LIMIT_EXCEEDED+" "+errorName);
			return;
		}

		switch (errorCode) {
		case SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE:
			imageName = "zerobyte.gif";
			break;
		case SWFUpload.QUEUE_ERROR.FILE_EXCEEDS_SIZE_LIMIT:
			imageName = "toobig.gif";
			break;
		case SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE:
		case SWFUpload.QUEUE_ERROR.INVALID_FILETYPE:
		default:
			//alert(message);
			break;
		}
        
        
        if(isImage(this.getFile(0).type))
        {
            addImage("images/" + imageName);
        }

	} catch (ex) {
		this.debug(ex);
	}

}

function fileDialogComplete(numFilesSelected, numFilesQueued) {
    //alert("fileDialogComplete");
	try {        
		if (numFilesQueued > 0) {
            //alert(this.getFile(0).id);
            if(isImage(this.getFile(0).type))            
            {
                this.startResizedUpload(this.getFile(0).id, this.customSettings.thumbnail_width, this.customSettings.thumbnail_height, SWFUpload.RESIZE_ENCODING.JPEG, this.customSettings.thumbnail_quality, false);
            }
            else
            {
                //this.startUpload(this.getFile(0).id);
                
                this.startUpload();
            }                       
		}
	} catch (ex) {
		this.debug(ex);
	}
}

function fileDialogCompleteFiles(numFilesSelected, numFilesQueued) {
	try {		
		/* I want auto start the upload and I can do that here */
		this.startUpload();
	} catch (ex)  {
        this.debug(ex);
	}
}

function isImage(type)
{
    //alert(type);
    switch(type)
    {
        case ".gif":
        case ".GIF":
        case ".jpg":
        case ".JPG":
        case ".jpeg":
        case ".JPEG":
        case ".bmp":
        case ".BMP":
        case ".png": 
        case ".PNG" :
            return true;
    }
    return false;
}

function uploadProgress(file, bytesLoaded) {
//    alert("uploadProgress");
	try {
/*		var percent = Math.ceil((bytesLoaded / file.size) * 100);

		var progress = new FileProgress(file,  this.customSettings.upload_target);
		progress.setProgress(percent);
		progress.setStatus("Uploading...");
		progress.toggleCancel(true, this);
*/
	} catch (ex) {
		this.debug(ex);
	}
}

function uploadSuccess(file, serverData) {
    alert("uploadSuccess");
	try {
		var progress = new FileProgress(file,  this.customSettings.upload_target);

        //alert(serverData.toSource())
         var res = Ext.util.JSON.decode( serverData );
         alert(res.toSource())
         if(res.success)
         {
             //alert(res.filename)        
            if(isImage(this.getFile(0).type))
            {            
                addImage(res.folder,res.filename,res.filebase,res.thumbnails,res.dimension);
            }
             
             progress.setStatus("Upload Complete.");
             progress.toggleCancel(false);
         }
/*		if (serverData.substring(0, 7) === "FILEID:") {
			addImage("thumbnail.php?id=" + serverData.substring(7));

			progress.setStatus("Upload Complete.");
			progress.toggleCancel(false);
		} else {
			addImage("images/error.gif");
			progress.setStatus("Error.");
			progress.toggleCancel(false);
			alert(serverData);

		}

*/
	} catch (ex) {
		this.debug(ex);
	}
}

function uploadComplete(file) {
    alert("uploadComplete");
	try {
		/*  I want the next upload to continue automatically so I'll call startUpload here */
		if (this.getStats().files_queued > 0) {
			this.startResizedUpload(this.getFile(0).ID, this.customSettings.thumbnail_width, this.customSettings.thumbnail_height, SWFUpload.RESIZE_ENCODING.JPEG, this.customSettings.thumbnail_quality, false);
		} else {
			var progress = new FileProgress(file,  this.customSettings.upload_target);
			progress.setComplete();
			progress.setStatus("All images received.");
			progress.toggleCancel(false);
		}
	} catch (ex) {
		this.debug(ex);
	}
}

function uploadCompleteFile(file) {
    alert("uploadCompleteFile");
	try {
		/*  I want the next upload to continue automatically so I'll call startUpload here */
		if (this.getStats().files_queued > 0) {
//			this.startResizedUpload(this.getFile(0).ID, this.customSettings.thumbnail_width, this.customSettings.thumbnail_height, SWFUpload.RESIZE_ENCODING.JPEG, this.customSettings.thumbnail_quality, false);
		} else {
			var progress = new FileProgress(file,  this.customSettings.upload_target);
			progress.setComplete();
			progress.setStatus("Todos los archivos fueron recibidos.");
			progress.toggleCancel(false);
		}
	} catch (ex) {
		this.debug(ex);
	}
}

function uploadError(file, errorCode, message) {
    //alert("uploadError---"+file.toSource()+"---"+errorCode.toSource()+"---"+message.toSource());
    
	var imageName =  "error.gif";
	var progress;
	try {
		switch (errorCode) {
		case SWFUpload.UPLOAD_ERROR.FILE_CANCELLED:
			try {
				progress = new FileProgress(file,  this.customSettings.upload_target);
				progress.setCancelled();
				progress.setStatus("Cancelled");
				progress.toggleCancel(false);
			}
			catch (ex1) {
				this.debug(ex1);
			}
			break;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_STOPPED:
			try {
				progress = new FileProgress(file,  this.customSettings.upload_target);
				progress.setCancelled();
				progress.setStatus("Stopped");
				progress.toggleCancel(true);
			}
			catch (ex2) {
				this.debug(ex2);
			}
		case SWFUpload.UPLOAD_ERROR.UPLOAD_LIMIT_EXCEEDED:
			imageName = "uploadlimit.gif";
			break;
		default:
			alert("5."+message);
			break;
		}
        //alert((this.getFile(0).type));
        if(isImage(file))
        {
            addImage("images/" + imageName);
        }

	} catch (ex3) {
		this.debug(ex3);
	}

}


function addImage(folder,filename,filebase,thumbnails,dimension) {
    alert("addImage");
    if(!thumbnails)
        thumbnails="thumbnails";
	var newImg = document.createElement("img");
	newImg.style.margin = "5px";
	newImg.style.verticalAlign = "middle";
    
    $("#"+thumbnails).append('<div style="width:'+dimension+'px;height:'+dimension+'px;float: left;margin: 5px;" id="file_'+(j)+'">'
                        +'<div style="position:relative ">'
                            +'<div style="position:absolute;" >'
                                +'<img style=" vertical-align: middle;" src="/gestDocumental/verArchivo?idarchivo='+filebase+ '" width="'+dimension+'" height="'+dimension+'" />'
                            +'</div>'
                            +'<div style="position:absolute;top:0px;right:0px" >'
                                +'<a href=""><img src="/images/16x16/button_cancel.gif" onclick="deleteFile(&quot;'+filebase+'&quot;,&quot;file_'+(j++)+'&quot;) /></a>'                            
                            +'</div>'
                            
                        +'</div>'
                      +'</div>');
	//var divThumbs = document.getElementById(thumbnails);
	//divThumbs.insertBefore(newImg, divThumbs.firstChild);
	//document.getElementById("thumbnails").appendChild(newImg);
	if (newImg.filters) {
		try {
			newImg.filters.item("DXImageTransform.Microsoft.Alpha").opacity = 0;
		} catch (e) {
			// If it is not set initially, the browser will throw an error.  This will set it if it is not set yet.
			newImg.style.filter = 'progid:DXImageTransform.Microsoft.Alpha(opacity=' + 0 + ')';
		}
	} else {
		newImg.style.opacity = 0;
	}

	newImg.onload = function () {
		fadeIn(newImg, 0);
	};
	newImg.src = src;
}

function fadeIn(element, opacity) {
//    alert("fadeIn");
	var reduceOpacityBy = 5;
	var rate = 30;	// 15 fps


	if (opacity < 100) {
		opacity += reduceOpacityBy;
		if (opacity > 100) {
			opacity = 100;
		}

		if (element.filters) {
			try {
				element.filters.item("DXImageTransform.Microsoft.Alpha").opacity = opacity;
			} catch (e) {
				// If it is not set initially, the browser will throw an error.  This will set it if it is not set yet.
				element.style.filter = 'progid:DXImageTransform.Microsoft.Alpha(opacity=' + opacity + ')';
			}
		} else {
			element.style.opacity = opacity / 100;
		}
	}

	if (opacity < 100) {
		setTimeout(function () {
			fadeIn(element, opacity);
		}, rate);
	}
}



/* ******************************************
 *	FileProgress Object
 *	Control object for displaying file info
 * ****************************************** */

function FileProgress(file, targetID) {
    alert("FileProgress");
	this.fileProgressID = "divFileProgress";

	this.fileProgressWrapper = document.getElementById(this.fileProgressID);
	if (!this.fileProgressWrapper) {
		this.fileProgressWrapper = document.createElement("div");
		this.fileProgressWrapper.className = "progressWrapper";
		this.fileProgressWrapper.id = this.fileProgressID;

		this.fileProgressElement = document.createElement("div");
		this.fileProgressElement.className = "progressContainer";

		var progressCancel = document.createElement("a");
		progressCancel.className = "progressCancel";
		progressCancel.href = "#";
		progressCancel.style.visibility = "hidden";
		progressCancel.appendChild(document.createTextNode(" "));

		var progressText = document.createElement("div");
		progressText.className = "progressName";
		progressText.appendChild(document.createTextNode(file.name));

		var progressBar = document.createElement("div");
		progressBar.className = "progressBarInProgress";

		var progressStatus = document.createElement("div");
		progressStatus.className = "progressBarStatus";
		progressStatus.innerHTML = "&nbsp;";

		this.fileProgressElement.appendChild(progressCancel);
		this.fileProgressElement.appendChild(progressText);
		this.fileProgressElement.appendChild(progressStatus);
		this.fileProgressElement.appendChild(progressBar);

		this.fileProgressWrapper.appendChild(this.fileProgressElement);

		document.getElementById(targetID).appendChild(this.fileProgressWrapper);
		fadeIn(this.fileProgressWrapper, 0);

	} else {
		this.fileProgressElement = this.fileProgressWrapper.firstChild;
		this.fileProgressElement.childNodes[1].firstChild.nodeValue = file.name;
	}

	this.height = this.fileProgressWrapper.offsetHeight;

}
FileProgress.prototype.setProgress = function (percentage) {
	this.fileProgressElement.className = "progressContainer green";
	this.fileProgressElement.childNodes[3].className = "progressBarInProgress";
	this.fileProgressElement.childNodes[3].style.width = percentage + "%";
};
FileProgress.prototype.setComplete = function () {
	this.fileProgressElement.className = "progressContainer blue";
	this.fileProgressElement.childNodes[3].className = "progressBarComplete";
	this.fileProgressElement.childNodes[3].style.width = "";

};
FileProgress.prototype.setError = function () {
	this.fileProgressElement.className = "progressContainer red";
	this.fileProgressElement.childNodes[3].className = "progressBarError";
	this.fileProgressElement.childNodes[3].style.width = "";

};
FileProgress.prototype.setCancelled = function () {
	this.fileProgressElement.className = "progressContainer";
	this.fileProgressElement.childNodes[3].className = "progressBarError";
	this.fileProgressElement.childNodes[3].style.width = "";

};
FileProgress.prototype.setStatus = function (status) {
	this.fileProgressElement.childNodes[2].innerHTML = status;
};

FileProgress.prototype.toggleCancel = function (show, swfuploadInstance) {
	this.fileProgressElement.childNodes[0].style.visibility = show ? "visible" : "hidden";
	if (swfuploadInstance) {
		var fileID = this.fileProgressID;
		this.fileProgressElement.childNodes[0].onclick = function () {
			swfuploadInstance.cancelUpload(fileID);
			return false;
		};
	}
};
