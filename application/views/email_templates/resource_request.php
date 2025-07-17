<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- Mirrored from admindesigns.com/demos/classic/theme/email-templates/ping.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 21 Nov 2017 05:15:15 GMT -->

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252"/>
    <meta name="GENERATOR" content="Microsoft FrontPage 5.0"/>
    <meta name="ProgId" content="FrontPage.Editor.Document"/>
    <title>Resource Request Recieved-HRMS</title>
    <style type="text/css">
        /* Take care of image borders and formatting, client hacks */
        
        img {
            max-width: 600px;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }
        
        a img {
            border: none;
        }
        
        table {
            border-collapse: collapse !important;
        }
        
        #outlook a {
            padding: 0;
        }
        
        .ReadMsgBody {
            width: 100%;
        }
        
        .ExternalClass {
            width: 100%;
        }
        
        .backgroundTable {
            margin: 0 auto;
            padding: 0;
            width: 100% !important;
        }
        
        table td {
            border-collapse: collapse;
        }
        
        .ExternalClass * {
            line-height: 115%;
        }
        
        .container-for-gmail-android {
            width: 600px;
            margin-top: 60px;
        }
        /* General styling */
        
        * {
            font-family: Helvetica, Arial, sans-serif;
        }
        
        body {
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none;
            width: 100% !important;
            margin: 0 !important;
            height: 100%;
            color: #676767;
        }
        
        td {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 16px;
            color: #333;
            text-align: center;
            line-height: 21px;
        }
        
        a {
            color: #676767;
            text-decoration: none !important;
        }
        
        .pull-left {
            text-align: left;
        }
        
        .pull-right {
            text-align: right;
        }
        
        .header-lg,
        .header-md,
        .header-sm {
            font-size: 32px;
            font-weight: 600;
            line-height: normal;
            padding: 35px 0 0;
            color: #4d4d4d;
        }
        
        .header-md {
            font-size: 24px;
        }
        
        .header-sm {
            padding: 5px 0;
            font-size: 18px;
            line-height: 1.3;
        }
        
        .content-padding {
            padding: 20px;
        }
        .mobile-header-padding-right {
            width: 290px;
            text-align: right;
            padding-right: 10px;
        }
        
        .mobile-header-padding-left {
            width: 290px;
            text-align: center;
            padding-left: 10px;
            padding-bottom: 8px;
        }
        
       .free-text {
            width: 100% !important;
            padding: 10px 60px 0px;
        }
        
        .block-rounded {
            border-radius: 5px;
            border: 1px solid #e5e5e5;
            vertical-align: top;
        }
        
        .button {
            padding: 30px 0;
        }
        
        .info-block {
            padding: 0 20px;
            width: 260px;
        }
        
        .block-rounded {
            width: 260px;
        }
        
        .info-img {
            width: 258px;
            border-radius: 5px 5px 0 0;
        }
        
        .force-width-img {
            width: 480px;
            height: 1px !important;
        }
        
        .force-width-full {
            width: 600px;
            height: 1px !important;
        }
        
        .force-width-gmail {
            min-width: 600px;
            height: 0px !important;
            line-height: 1px !important;
            font-size: 1px !important;
        }
        
        .button-width {
            width: 228px;
        }
    </style>

    <style type="text/css" media="only screen and (max-width: 480px)">
        /* Mobile styles */
        
        @media only screen and (max-width: 480px) {
            .container-for-gmail-android {
                min-width: 270px !important;
                width: 100% !important;
            }
            
            img[class="force-width-gmail"] {
                display: none !important;
                width: 0 !important;
                height: 0 !important;
            }
            a[class="button-width"],
            a[class="button-mobile"] {
                width: 230px !important;
            }
            td[class*="mobile-header-padding-left"] {
                width: 160px !important;
                padding-left: 0 !important;
            }
            td[class*="mobile-header-padding-right"] {
                width: 160px !important;
                padding-right: 0 !important;
            }
            td[class="header-lg"] {
                font-size: 24px !important;
                padding-bottom: 5px !important;
            }
            td[class="header-md"] {
                font-size: 18px !important;
                padding-bottom: 5px !important;
            }
            td[class="content-padding"] {
                padding: 20px !important;
            }
            td[class="button"] {
                padding: 5px !important;
            }
            td[class*="free-text"] {
                padding: 10px 18px 30px !important;
            }
            img[class="force-width-img"],
            img[class="force-width-full"] {
                display: none !important;
            }
            td[class="info-block"] {
                display: block !important;
                width: 280px !important;
                padding-bottom: 40px !important;
            }
            td[class="info-img"],
            img[class="info-img"] {
                width: 278px !important;
            }
        }
    </style>
</head>
<?php 
    if(!empty($logo_img['company_inner_logo']) && file_exists(UPLOADPATH.'logo/'.$logo_img['company_inner_logo']))
    {
        $logo_img = base_url().LOGO_PATH.$logo_img['company_inner_logo'];
    }
    else
    {
        $logo_img = assets_url().'img/login.png';
    }
?>
<body bgcolor="#eee">
    <table style="border: 1px solid #eee;" align="center" cellpadding="0" cellspacing="0" class="container-for-gmail-android" width="100%">
        <tr>
            <td align="left" valign="top" width="100%" style="background: #ffffff;">

                <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ffffff" style="background-color:transparent">
                    <tr>
                        <td width="100%" height="75" valign="top" style="text-align: center; vertical-align:middle;">

                            <table cellpadding="0" cellspacing="0" width="100%" class="w320">
                                <tr>
                                   <td class="pull-left mobile-header-padding-left" style="vertical-align: middle; padding: 5px 0 5px 0; background: #000; opacity: 0.7">
                                    <img style="vertical-align: middle;" width="150" height="50" src="<?php echo $logo_img;?>"  alt="logo">
                            </table>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
        <tr>
            <td align="left" valign="top" width="100%" style="background: #e3975b;">
                <center>
                    <table cellspacing="0" cellpadding="0" width="100%" style="background: #e3975b; border-bottom: 1px dotted #999">
                        <tr>
                            <td width="100%" height="50" valign="top" style="text-align: center; vertical-align:middle;">
                                <center>
                                    <table cellpadding="0" cellspacing="1" class="w320" width="50%">
                                        <tr>
                                            <td style="color: #fff; ">
                                                <span style="font-size: 24px; vertical-align: middle;"><b>Resource Request Received</b></span>
                                            </td>
                                        </tr>
                                    </table>
                                </center>
                            </td>
                        </tr>
                    </table>
                </center>
            </td>
        </tr>

        <tr>
            <td align="left" valign="top" width="100%" style="background-color: #fff;" class="content-padding">
                <center>
                    <table cellspacing="0" cellpadding="1" width="100%" class="w320">
                        <tr>
                            <td style="text-align: left">
                                Dear Sir/ Madam,<br/>
                            </td>
                        </tr>
                        <tr height="10px"></tr>
                        <tr>
                            <td style="text-align: justify;text-justify: inter-word;">
                               &emsp; This to let you know that new resources are requested for the position of <?php echo $title." by ".$can_name;?>. The vacant positions for this profile are <?php echo $no_of_positions;?>. The Job Duties for this designation are below : <br> <?php echo $job_description;?>
                            </td>
                        </tr>
                        <tr height="10px"></tr>
                        <tr>
                            <td style="text-align: left">
                                You are requested to look into this matter and further process the candidature if suits the requirement. 
                            </td>
                        </tr>
                        <tr height="10px"></tr>
                        <tr>
                            <td style="text-align: left">
                                Thanks,
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left">
                              esuitex
                            </td>
                        </tr>
                        
                    </table>
                </center>
            </td>
        </tr>

    </table>
</body>

</html>
