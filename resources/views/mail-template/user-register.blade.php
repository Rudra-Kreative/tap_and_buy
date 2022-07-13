<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
        <title></title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,400;0,500;0,600;0,800;0,900;1,200;1,300;1,400;1,600;1,800;1,900&display=swap" rel="stylesheet">
        <style type="text/css">
        
        
        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
        line-height: 100%;
        }
        body,
        table,
        td,
        p,
        a,
        li,
        blockquote {
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
        }
        table,
        td {
        border-collapse: collapse;
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
        }
        img {
        -ms-interpolation-mode: bicubic;
        }
        #button a {
        color: #FFFFFF;
        }
        a:link img {
        display: block;
        }
        body {
        margin: 0;
        padding: 0;
        text-align: left !important;
        }
        img {
        border: 0;
        height: auto;
        line-height: 100%;
        outline: none;
        text-decoration: none;
        }
        body,
        #bodyTable,
        #bodyCell,
        #bodyCellFooter {
        height: 100% !important;
        margin: 0px !important;
        padding: 0px !important;
        width: 100% !important;
        }
        a img {
        border: none !important;
        }
        
        body {
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
        -webkit-font-smoothing: antialiased;
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;   font-family: 'Poppins', sans-serif;
        }
        
        @media only screen and (max-width: 767px) {
        
        }
        
        </style>
    </head>
    <body style="margin: 0px;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;-webkit-font-smoothing: antialiased;padding: 0px !important;text-align: left !important;width: 100% !important;height: 100% !important;">
        <table style="border: 0px solid #ddd;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;padding:0 30px;" width="600" cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#fff"
            class="main">
            <tbody>
                <!--==============banner start here===============-->
                
                
                <tr>
                    <td style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                            <tbody>
                               
                                
                                <tr>
                                    <td align="center" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;background: #F9F9F9;">
                                       <h1 style="    font-weight: 500;font-size: 24px;line-height: 36px;text-align: center;letter-spacing: 0.01em;text-transform: uppercase; color: #fff;padding: 10px;background-color: #1a4568;">Thank you for signing up Mr./Mrs. {{ $event->payload['name'] }}</h1>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td align="center" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;background: #F9F9F9;    padding: 20px 60px;">
                                       <p style="   font-weight: 400;font-size: 14px;line-height: 21px; text-align: center;color: #010101;">Your one time password is: <b>{{ $event->payload['password'] }}</b>. Please login and change your password.  </p>
                                        <a href="#" style="    background-color: #1a4568;
                                        display: inline-block;
                                        color: #ffffff;
                                        font-size: 15px;
                                        font-weight: 500;
                                        letter-spacing: 0.15px;
                                        padding: 13px 37px;
                                        text-decoration: none;">
                                       Login Now
                                        </a>
                                      
                                    </td>
                                </tr>

                                <tr>
                                    <td align="center" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;background: #F9F9F9;    padding: 20px 0px;">
                                      
                                        <p style="    background-color: #1a4568;
                                        display: block;
                                        color: #ffffff;
                                        font-size: 13px;
                                        font-weight: 300;
                                        letter-spacing: 0.15px;
                                        padding: 13px 37px;
                                        text-decoration: none;">
                                         ©{{ date('Y') }} Tap & Buy All Rights Reserved

                                        </p>
                                       
                                      
                                    </td>
                                </tr>
                                
                             

                            </tbody>
                        </table>
                    </td>
                </tr>
               
            </table>
        </body>
    </html>