<?php
    function getMimeType($ext){
            $ext = strtolower($ext);
            $ext = "." . pathinfo($ext, PATHINFO_EXTENSION);
            switch ($ext) {
                case '.aac': $mime ='audio/aac'; break; // AAC audio
                case '.abw': $mime ='application/x-abiword'; break; // AbiWord document
                case '.arc': $mime ='application/octet-stream'; break; // Archive document (multiple files embedded)
                case '.avi': $mime ='video/x-msvideo'; break; // AVI: Audio Video Interleave
                case '.azw': $mime ='application/vnd.amazon.ebook'; break; // Amazon Kindle eBook format
                case '.bin': $mime ='application/octet-stream'; break; // Any kind of binary data
                case '.bmp': $mime ='image/bmp'; break; // Windows OS/2 Bitmap Graphics
                case '.bz': $mime ='application/x-bzip'; break; // BZip archive
                case '.bz2': $mime ='application/x-bzip2'; break; // BZip2 archive
                case '.csh': $mime ='application/x-csh'; break; // C-Shell script
                case '.css': $mime ='text/css'; break; // Cascading Style Sheets (CSS)
                case '.csv': $mime ='text/csv'; break; // Comma-separated values (CSV)
                case '.doc': $mime ='application/msword'; break; // Microsoft Word
                case '.docx': $mime ='application/vnd.openxmlformats-officedocument.wordprocessingml.document'; break; // Microsoft Word (OpenXML)
                case '.eot': $mime ='application/vnd.ms-fontobject'; break; // MS Embedded OpenType fonts
                case '.epub': $mime ='application/epub+zip'; break; // Electronic publication (EPUB)
                case '.gif': $mime ='image/gif'; break; // Graphics Interchange Format (GIF)
                case '.htm': $mime ='text/html'; break; // HyperText Markup Language (HTML)
                case '.html': $mime ='text/html'; break; // HyperText Markup Language (HTML)
                case '.ico': $mime ='image/x-icon'; break; // Icon format
                case '.ics': $mime ='text/calendar'; break; // iCalendar format
                case '.jar': $mime ='application/java-archive'; break; // Java Archive (JAR)
                case '.jpeg': $mime ='image/jpeg'; break; // JPEG images
                case '.jpg': $mime ='image/jpeg'; break; // JPEG images
                case '.js': $mime ='application/javascript'; break; // JavaScript (IANA Specification) (RFC 4329 Section 8.2)
                case '.json': $mime ='application/json'; break; // JSON format
                case '.mid': $mime ='audio/midi audio/x-midi'; break; // Musical Instrument Digital Interface (MIDI)
                case '.midi': $mime ='audio/midi audio/x-midi'; break; // Musical Instrument Digital Interface (MIDI)
                case '.mpeg': $mime ='video/mpeg'; break; // MPEG Video
                case '.mpkg': $mime ='application/vnd.apple.installer+xml'; break; // Apple Installer Package
                case '.odp': $mime ='application/vnd.oasis.opendocument.presentation'; break; // OpenDocument presentation document
                case '.ods': $mime ='application/vnd.oasis.opendocument.spreadsheet'; break; // OpenDocument spreadsheet document
                case '.odt': $mime ='application/vnd.oasis.opendocument.text'; break; // OpenDocument text document
                case '.oga': $mime ='audio/ogg'; break; // OGG audio
                case '.ogv': $mime ='video/ogg'; break; // OGG video
                case '.ogx': $mime ='application/ogg'; break; // OGG
                case '.otf': $mime ='font/otf'; break; // OpenType font
                case '.png': $mime ='image/png'; break; // Portable Network Graphics
                case '.pdf': $mime ='application/pdf'; break; // Adobe Portable Document Format (PDF)
                case '.ppt': $mime ='application/vnd.ms-powerpoint'; break; // Microsoft PowerPoint
                case '.pptx': $mime ='application/vnd.openxmlformats-officedocument.presentationml.presentation'; break; // Microsoft PowerPoint (OpenXML)
                case '.rar': $mime ='application/x-rar-compressed'; break; // RAR archive
                case '.rtf': $mime ='application/rtf'; break; // Rich Text Format (RTF)
                case '.sh': $mime ='application/x-sh'; break; // Bourne shell script
                case '.svg': $mime ='image/svg+xml'; break; // Scalable Vector Graphics (SVG)
                case '.swf': $mime ='application/x-shockwave-flash'; break; // Small web format (SWF) or Adobe Flash document
                case '.tar': $mime ='application/x-tar'; break; // Tape Archive (TAR)
                case '.tif': $mime ='image/tiff'; break; // Tagged Image File Format (TIFF)
                case '.tiff': $mime ='image/tiff'; break; // Tagged Image File Format (TIFF)
                case '.ts': $mime ='application/typescript'; break; // Typescript file
                case '.ttf': $mime ='font/ttf'; break; // TrueType Font
                case '.txt': $mime ='text/plain'; break; // Text, (generally ASCII or ISO 8859-n)
                case '.vsd': $mime ='application/vnd.visio'; break; // Microsoft Visio
                case '.wav': $mime ='audio/wav'; break; // Waveform Audio Format
                case '.weba': $mime ='audio/webm'; break; // WEBM audio
                case '.webm': $mime ='video/webm'; break; // WEBM video
                case '.webp': $mime ='image/webp'; break; // WEBP image
                case '.woff': $mime ='font/woff'; break; // Web Open Font Format (WOFF)
                case '.woff2': $mime ='font/woff2'; break; // Web Open Font Format (WOFF)
                case '.xhtml': $mime ='application/xhtml+xml'; break; // XHTML
                case '.xls': $mime ='application/vnd.ms-excel'; break; // Microsoft Excel
                case '.xlsx': $mime ='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'; break; // Microsoft Excel (OpenXML)
                case '.xml': $mime ='application/xml'; break; // XML
                case '.xul': $mime ='application/vnd.mozilla.xul+xml'; break; // XUL
                case '.zip': $mime ='application/zip'; break; // ZIP archive
                case '.3gp': $mime ='video/3gpp'; break; // 3GPP audio/video container
                case '.3g2': $mime ='video/3gpp2'; break; // 3GPP2 audio/video container
                case '.7z': $mime ='application/x-7z-compressed'; break; // 7-zip archive
                default: $mime = 'application/octet-stream' ; // general purpose MIME-type
            }
            return $mime ; 
    }
?>