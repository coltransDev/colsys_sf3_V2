<?

function mime_type_icon( $name , $size = "22", $options=array()){
	
	$folder = $size."x".$size;
	switch( strtolower(substr($name,-3,3) ) ){
		case "gif":
			return image_tag($folder."/mimetypes/image2.gif", $options);
			break;
		case "jpg":
			return image_tag($folder."/mimetypes/image2.gif", $options);
			break;
		case "jpeg":
			return image_tag($folder."/mimetypes/image2.gif", $options);
			break;
		 case "png":
			return image_tag($folder."/mimetypes/image2.gif", $options);
			break;
		case "doc":
			return image_tag($folder."/mimetypes/doc.gif", $options);
			break;
		case "xls":
			return image_tag($folder."/mimetypes/spreadsheet_document.gif", $options);
			break;
		case "bmp":
			return image_tag($folder."/mimetypes/image2.gif", $options);
			break;
		case "tiff":
			return image_tag($folder."/mimetypes/image2.gif", $options);
			break;
		case "tif":
			return image_tag($folder."/mimetypes/image2.gif", $options);
			break;
		case "rtf":
			return image_tag($folder."/mimetypes/doc.gif", $options);
			break;
		case "htm":
			return image_tag($folder."/mimetypes/html.gif", $options);
			break;
		case "html":
			return image_tag($folder."/mimetypes/html.gif", $options);
			break;
		case "pdf":            
			return image_tag($folder."/mimetypes/pdf_document.gif", $options);
			break;
		case "zip":
			return image_tag($folder."/mimetypes/package.gif", $options);
			break;
		default:
			return image_tag($folder."/mimetypes/binary.gif", $options);
			break;
	}

}
?>