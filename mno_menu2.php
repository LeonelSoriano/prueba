<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 01/01/15
 * Time: 03:06 PM
 */

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>SICAP | Sistema Integral de Costos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/style_new.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/zerogrid.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/responsive.css" type="text/css" media="all">


    <!--<link rel="stylesheet" media="screen" href="http://openfontlibrary.org/face/dancing" rel="stylesheet" type="text/css"/>-->
    <script src="js/jquery-1.6.2.min.js" type="text/javascript"></script>
    <script src="js/cufon-yui.js" type="text/javascript"></script>
    <script src="js/cufon-replace.js" type="text/javascript"></script>
    <script src="js/Vegur_300.font.js" type="text/javascript"></script>
    <script src="js/Vegur_400.font.js" type="text/javascript"></script>
    <script src="js/FF-cash.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/css3-mediaqueries.js"></script>
    <!--[if lt IE 7]>
    <div style=' clear: both; text-align:center; position: relative;'>
        <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0"  alt="" /></a>
    </div>
    <![endif]-->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="js/html5.js"></script>
    <link rel="stylesheet" href="css/ie.css" type="text/css" media="screen">
    <![endif]-->
    <style>


        h2, p {
            text-align: center;
            color: #444;
            text-shadow: 0 1px 0 #fff;
        }

        a {
            color: #2A679F;
        }

        /* You don't need the above styles, they are demo-specific ----------- */

        #menu, #menu ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        #menu {
            width: 960px;
            margin: 60px auto;
            border: 1px solid #222;
            background-color: #111;
            background-image: -moz-linear-gradient(#444, #111);
            background-image: -webkit-gradient(linear, left top, left bottom, from(#444), to(#111));
            background-image: -webkit-linear-gradient(#444, #111);
            background-image: -o-linear-gradient(#444, #111);
            background-image: -ms-linear-gradient(#444, #111);
            background-image: linear-gradient(#444, #111);
            -moz-border-radius: 6px;
            -webkit-border-radius: 6px;
            border-radius: 6px;
            -moz-box-shadow: 0 1px 1px #777, 0 1px 0 #666 inset;
            -webkit-box-shadow: 0 1px 1px #777, 0 1px 0 #666 inset;
            box-shadow: 0 1px 1px #777, 0 1px 0 #666 inset;
        }

        #menu:before,
        #menu:after {
            content: "";
            display: table;
        }

        #menu:after {
            clear: both;
        }

        #menu {
            zoom:1;
        }

        #menu li {
            float: left;
            border-right: 1px solid #222;
            -moz-box-shadow: 1px 0 0 #444;
            -webkit-box-shadow: 1px 0 0 #444;
            box-shadow: 1px 0 0 #444;
            position: relative;

        }

        #menu a {
            float: left;
            padding: 12px 30px;
            color: #999;
            text-transform: uppercase;
            font: bold 12px Arial, Helvetica;
            text-decoration: none;
            text-shadow: 0 1px 0 #000;
        }

        #menu li:hover > a {
            color: #fafafa;
        }

        *html #menu li a:hover { /* IE6 only */
            color: #fafafa;
        }

        #menu ul {
            margin: 20px 0 0 0;
            _margin: 0; /*IE6 only*/
            opacity: 0;
            visibility: hidden;
            position: absolute;
            top: 38px;
            left: 0;
            z-index: 1;
            background: #444;
            background: -moz-linear-gradient(#444, #111);
            background-image: -webkit-gradient(linear, left top, left bottom, from(#444), to(#111));
            background: -webkit-linear-gradient(#444, #111);
            background: -o-linear-gradient(#444, #111);
            background: -ms-linear-gradient(#444, #111);
            background: linear-gradient(#444, #111);
            -moz-box-shadow: 0 -1px rgba(255,255,255,.3);
            -webkit-box-shadow: 0 -1px 0 rgba(255,255,255,.3);
            box-shadow: 0 -1px 0 rgba(255,255,255,.3);
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
            border-radius: 3px;
            -webkit-transition: all .2s ease-in-out;
            -moz-transition: all .2s ease-in-out;
            -ms-transition: all .2s ease-in-out;
            -o-transition: all .2s ease-in-out;
            transition: all .2s ease-in-out;
        }

        #menu li:hover > ul {
            opacity: 1;
            visibility: visible;
            margin: 0;
        }

        #menu ul ul {
            top: 0;
            left: 150px;
            margin: 0 0 0 20px;
            _margin: 0; /*IE6 only*/
            -moz-box-shadow: -1px 0 0 rgba(255,255,255,.3);
            -webkit-box-shadow: -1px 0 0 rgba(255,255,255,.3);
            box-shadow: -1px 0 0 rgba(255,255,255,.3);
        }

        #menu ul li {
            float: none;
            display: block;
            border: 0;
            _line-height: 0; /*IE6 only*/
            -moz-box-shadow: 0 1px 0 #111, 0 2px 0 #666;
            -webkit-box-shadow: 0 1px 0 #111, 0 2px 0 #666;
            box-shadow: 0 1px 0 #111, 0 2px 0 #666;
        }

        #menu ul li:last-child {
            -moz-box-shadow: none;
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        #menu ul a {
            padding: 10px;
            width: 160px;
            _height: 10px; /*IE6 only*/
            display: block;
            white-space: nowrap;
            float: none;
            text-transform: none;

        }

        #menu ul a:hover {
            background-color: #0186ba;
            background-image: -moz-linear-gradient(#04acec,  #0186ba);
            background-image: -webkit-gradient(linear, left top, left bottom, from(#04acec), to(#0186ba));
            background-image: -webkit-linear-gradient(#04acec, #0186ba);
            background-image: -o-linear-gradient(#04acec, #0186ba);
            background-image: -ms-linear-gradient(#04acec, #0186ba);
            background-image: linear-gradient(#04acec, #0186ba);
        }

        #menu ul li:first-child > a {
            -moz-border-radius: 3px 3px 0 0;
            -webkit-border-radius: 3px 3px 0 0;
            border-radius: 3px 3px 0 0;
        }

        #menu ul li:first-child > a:after {
            content: '';
            position: absolute;
            left: 40px;
            top: -6px;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-bottom: 6px solid #444;
        }

        #menu ul ul li:first-child a:after {
            left: -6px;
            top: 50%;
            margin-top: -6px;
            border-left: 0;
            border-bottom: 6px solid transparent;
            border-top: 6px solid transparent;
            border-right: 6px solid #3b3b3b;
        }

        #menu ul li:first-child a:hover:after {
            border-bottom-color: #04acec;
        }

        #menu ul ul li:first-child a:hover:after {
            border-right-color: #0299d3;
            border-bottom-color: transparent;
        }

        #menu ul li:last-child > a {
            -moz-border-radius: 0 0 3px 3px;
            -webkit-border-radius: 0 0 3px 3px;
            border-radius: 0 0 3px 3px;
        }

        /* Mobile */
        #menu-trigger {
            display: none;
        }

        @media screen and (max-width: 600px) {

            /* nav-wrap */
            #menu-wrap {
                position: relative;

            }

            #menu-wrap * {
                -moz-box-sizing: border-box;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;position: relative;
            }

            /* menu icon */
            #menu-trigger {
                display: block; /* show menu icon */
                height: 40px;
                line-height: 40px;
                cursor: pointer;
                padding: 0 0 0 35px;
                border: 1px solid #222;
                color: #fafafa;
                font-weight: bold;
                background-color: #111;

                -moz-border-radius: 6px;
                -webkit-border-radius: 6px;
                border-radius: 6px;
                -moz-box-shadow: 0 1px 1px #777, 0 1px 0 #666 inset;
                -webkit-box-shadow: 0 1px 1px #777, 0 1px 0 #666 inset;
                box-shadow: 0 1px 1px #777, 0 1px 0 #666 inset;
                background-color: #111;
                background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABIAAAAPCAMAAADeWG8gAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyBpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBXaW5kb3dzIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjE2QjAxNjRDOUNEOTExRTE4RTNFRkI1RDQ2MUYxOTQ3IiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjE2QjAxNjREOUNEOTExRTE4RTNFRkI1RDQ2MUYxOTQ3Ij4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6MTZCMDE2NEE5Q0Q5MTFFMThFM0VGQjVENDYxRjE5NDciIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6MTZCMDE2NEI5Q0Q5MTFFMThFM0VGQjVENDYxRjE5NDciLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz42AEtnAAAABlBMVEX///////9VfPVsAAAAAnRSTlP/AOW3MEoAAAAWSURBVHjaYmAgFzBiACKFho6NAAEGAD07AG1pn932AAAAAElFTkSuQmCC) no-repeat 10px center, -moz-linear-gradient(#444, #111);
                background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABIAAAAPCAMAAADeWG8gAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyBpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBXaW5kb3dzIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjE2QjAxNjRDOUNEOTExRTE4RTNFRkI1RDQ2MUYxOTQ3IiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjE2QjAxNjREOUNEOTExRTE4RTNFRkI1RDQ2MUYxOTQ3Ij4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6MTZCMDE2NEE5Q0Q5MTFFMThFM0VGQjVENDYxRjE5NDciIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6MTZCMDE2NEI5Q0Q5MTFFMThFM0VGQjVENDYxRjE5NDciLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz42AEtnAAAABlBMVEX///////9VfPVsAAAAAnRSTlP/AOW3MEoAAAAWSURBVHjaYmAgFzBiACKFho6NAAEGAD07AG1pn932AAAAAElFTkSuQmCC) no-repeat 10px center, -webkit-linear-gradient(#444, #111);
                background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABIAAAAPCAMAAADeWG8gAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyBpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBXaW5kb3dzIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjE2QjAxNjRDOUNEOTExRTE4RTNFRkI1RDQ2MUYxOTQ3IiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjE2QjAxNjREOUNEOTExRTE4RTNFRkI1RDQ2MUYxOTQ3Ij4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6MTZCMDE2NEE5Q0Q5MTFFMThFM0VGQjVENDYxRjE5NDciIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6MTZCMDE2NEI5Q0Q5MTFFMThFM0VGQjVENDYxRjE5NDciLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz42AEtnAAAABlBMVEX///////9VfPVsAAAAAnRSTlP/AOW3MEoAAAAWSURBVHjaYmAgFzBiACKFho6NAAEGAD07AG1pn932AAAAAElFTkSuQmCC) no-repeat 10px center, -o-linear-gradient(#444, #111);
                background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABIAAAAPCAMAAADeWG8gAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyBpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBXaW5kb3dzIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjE2QjAxNjRDOUNEOTExRTE4RTNFRkI1RDQ2MUYxOTQ3IiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjE2QjAxNjREOUNEOTExRTE4RTNFRkI1RDQ2MUYxOTQ3Ij4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6MTZCMDE2NEE5Q0Q5MTFFMThFM0VGQjVENDYxRjE5NDciIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6MTZCMDE2NEI5Q0Q5MTFFMThFM0VGQjVENDYxRjE5NDciLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz42AEtnAAAABlBMVEX///////9VfPVsAAAAAnRSTlP/AOW3MEoAAAAWSURBVHjaYmAgFzBiACKFho6NAAEGAD07AG1pn932AAAAAElFTkSuQmCC) no-repeat 10px center, -ms-linear-gradient(#444, #111);
                background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABIAAAAPCAMAAADeWG8gAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyBpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBXaW5kb3dzIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjE2QjAxNjRDOUNEOTExRTE4RTNFRkI1RDQ2MUYxOTQ3IiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjE2QjAxNjREOUNEOTExRTE4RTNFRkI1RDQ2MUYxOTQ3Ij4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6MTZCMDE2NEE5Q0Q5MTFFMThFM0VGQjVENDYxRjE5NDciIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6MTZCMDE2NEI5Q0Q5MTFFMThFM0VGQjVENDYxRjE5NDciLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz42AEtnAAAABlBMVEX///////9VfPVsAAAAAnRSTlP/AOW3MEoAAAAWSURBVHjaYmAgFzBiACKFho6NAAEGAD07AG1pn932AAAAAElFTkSuQmCC) no-repeat 10px center, linear-gradient(#444, #111);
            }

            /* main nav */
            #menu {
                margin: 0; padding: 10px;
                position: absolute;
                top: 40px;
                width: 100%;
                z-index: 1;
                background-color: #444;

                -moz-box-shadow: none;
                -webkit-box-shadow: none;
                box-shadow: none;
            }

            #menu:after {
                content: '';
                position: absolute;
                left: 25px;
                top: -8px;
                border-left: 8px solid transparent;
                border-right: 8px solid transparent;
                border-bottom: 8px solid #444;
            }

            #menu ul {
                position: static;
                visibility: visible;
                opacity: 1;
                margin: 0;
                background: none;
                -moz-box-shadow: none;
                -webkit-box-shadow: none;
                box-shadow: none;
            }

            #menu ul ul {
                margin: 0 0 0 20px !important;
                -moz-box-shadow: none;
                -webkit-box-shadow: none;
                box-shadow: none;
            }

            #menu li {
                position: static;
                display: block;
                float: none;
                border: 0;
                margin: 5px;
                -moz-box-shadow: none;
                -webkit-box-shadow: none;
                box-shadow: none;
            }

            #menu ul li{
                margin-left: 20px;
                -moz-box-shadow: none;
                -webkit-box-shadow: none;
                box-shadow: none;
            }

            #menu a{
                display: block;
                float: none;
                padding: 0;
                color: #999;
            }

            #menu a:hover{
                color: #fafafa;
            }

            #menu ul a{
                padding: 0;
                width: auto;
            }

            #menu ul a:hover{
                background: none;
            }

            #menu ul li:first-child a:after,
            #menu ul ul li:first-child a:after {
                border: 0;
            }

        }

        @media screen and (min-width: 600px) {
            #menu {
                display: block !important;
            }
        }

        /* iPad */
        .no-transition {
            -webkit-transition: none;
            -moz-transition: none;
            -ms-transition: none;
            -o-transition: none;
            transition: none;
            opacity: 1;
            visibility: visible;
            display: none;
        }

        #menu li:hover > .no-transition {
            display: block;
        }

        .js-video {
            height: 0;
            padding-top: 25px;
            padding-bottom: 50.5%;
            margin-bottom: 10px;
            position: relative;
            overflow: hidden;
        }

        .js-video.widescreen {
            padding-bottom: 56.34%;
        }

        .js-video.vimeo {
            padding-top: 0;
        }

        .js-video embed, .js-video iframe, .js-video object, .js-video video {
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            position: absolute;
        }

    </style>

</head>
<body id="page5">
<div class="bg">
    <!-- header -->
    <header>
        <div class="menu-row">
            <div class="main">
                <div class="zerogrid">
                    <div class="row" >

                        <h1 id="header_nombre" style="display: table;margin-bottom: 12px">
                            <div id="header_nombre_span" style=" display: table-cell;
vertical-align: middle;">
                                Módulo de Nómina
                            </div> </h1>


                        <div class="col-full"><div class="wrap-col" style="margin-top: 0px;">

                                <ul class="menu">
                                    <nav id="menu-wrap">
                                        <ul id="menu">
                                            <li><a href="seleccion_sicap.php">Home</a></li>

                                            <li>
                                                <a href="">Datos Básicos</a>
                                                <ul>
                                                    <li><a href="./mno/gerencia/gerencia.php">Gerencia</a></li>
                                                    <li><a href="./mno/bonos_produccion/nuevo_bono.php">Nuevo Bono Producción</a></li>
                                                    <li><a href="./mno/bonos_produccion/seleccion_bonos.php">Tabulador Nuevos Bonos</a></li>
                                                    <li><a href="./mno/concepto_salarios/concepto_salarios2.php">Sueldos y Salarios</a></li>
                                                </ul>
                                            </li>


                                            <li>
                                                <a href="">Reporte</a>
                                                <ul>

                                                    <li><a href="./mno/reporte/reporte_salario.php">Reporte Salarios</a></li>
                                                    <li><a href="./mno/reporte/pre_reporte_costo_empleado.php">Reporte Costo Empleado</a></li>
                                                    <li><a href="./mno/reporte/pre_reporte_costo_despartamento.php">Reporte Costo Departamento</a></li>

                                                </ul>

                                            </li>



                                            <li>
                                                <a href="">Importar</a>
                                                <ul>
                                                    <li><a href="./mno/importar/importar_sueldo.php">Importar Datos</a></li>

                                                </ul>


                                            </li>


                                        </ul>
                                    </nav>
                                </ul>


                            </div></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- content -->
    <section id="content">
        <div class="main">
            <div class="zerogrid">
                <div class="row">
                    <article class="col-2-3"><div class="wrap-col">
                            <!-- VIDEO -->

                            <div class="js-video [vimeo, widescreen]">
                                <video controls>

                                    <source src="ejemplo.mp4" type="video/mp4">
                                    Your browser does not support HTML5 video.
                                </video>
                            </div>


                        </div></article>
                    <article class="col-1-3"><div class="wrap-col">
                            <h3 class="p2">Informacion del Modulo</h3>


                        </div></article>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- aside -->


<!-- footer -->
<footer>
    <div class="main" >
        <div class="zerogrid" id="mi_footer" >


            <div class="zerogrid">
                <div class="row" id="mi-footer">
                    <article class="col-1-2"><div class="wrap-col">

                            <p   style="color:#a8a8a8">
                                <span class="letra-verde"> Gupo SICAP</span> Barquisimeto Estado Lara 2014 <br/>
                                Avenida Vargas Esquina Carera 24 Cámara de comercio segundo piso oficina numero 4

                        </div></article>
                    <article class="col-1-2"><div class="wrap-col">
                            <div class="indent-left3">

                                <p class="indent-bot" style="color:#a8a8a8"> Teléfonos: (0251)233 3367 <br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp;(0412)641 5861</p>


                            </div>
                        </div></article>

                </div>
            </div>


        </div>
    </div>
</footer>
<script type="text/javascript"> Cufon.now(); </script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<script type="text/javascript">
    $(function() {
        if ($.browser.msie && $.browser.version.substr(0,1)<7)
        {
            $('li').has('ul').mouseover(function(){
                $(this).children('ul').css('visibility','visible');
            }).mouseout(function(){
                $(this).children('ul').css('visibility','hidden');
            })
        }

        /* Mobile */
        $('#menu-wrap').prepend('<div id="menu-trigger">Menu</div>');
        $("#menu-trigger").on("click", function(){
            $("#menu").slideToggle();
        });

        // iPad
        var isiPad = navigator.userAgent.match(/iPad/i) != null;
        if (isiPad) $('#menu ul').addClass('no-transition');
    });
</script>
</body>
</html>
