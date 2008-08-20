<?

function mime_type_icon( $name ){	
	
	switch( strtolower(substr($name,-3,3) ) ){
		case "gif":
			return image_tag("22x22/mimetypes/image2.gif");
			break;
		case "jpg":
			return image_tag("22x22/mimetypes/image2.gif");
			break;
		case "jpeg":
			return image_tag("22x22/mimetypes/image2.gif");
			break;
		 case "png":
			return image_tag("22x22/mimetypes/image2.gif");
			break;
		case "doc":
			return image_tag("22x22/mimetypes/doc.gif");
			break;
		case "xls":
			return image_tag("22x22/mimetypes/spreadsheet_document.gif");
			break;
		case "bmp":
			return image_tag("22x22/mimetypes/image2.gif");
			break;
		case "tiff":
			return image_tag("22x22/mimetypes/image2.gif");
			break;
		case "tif":
			return image_tag("22x22/mimetypes/image2.gif");
			break;
		case "rtf":
			return image_tag("22x22/mimetypes/doc.gif");
			break;
		case "htm":
			return image_tag("22x22/mimetypes/html.gif");
			break;
		case "html":
			return image_tag("22x22/mimetypes/html.gif");
			break;
		case "pdf":
			return image_tag("22x22/mimetypes/pdf_document.gif");
			break;
		case "zip":
			return image_tag("22x22/mimetypes/package.gif");
			break;
		default:
			return image_tag("22x22/mimetypes/binary.gif");
			break;
	}

}
?>