<!--
 * Template Name: Unify - Responsive Bootstrap Template
 * Description: Business, Corporate, Portfolio and Blog Theme.
 * Version: 1.6
 * Author: @htmlstream
 * Website: http://htmlstream.com
 -->
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Responsive Email Template</title>

    <style type="text/css">
        .ReadMsgBody {
            width: 100%;
            background-color: #ffffff;
        }

        .ExternalClass {
            width: 100%;
            background-color: #ffffff;
        }

        body {
            width: 100%;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            font-family: Arial, Helvetica, sans-serif
        }

        table {
            border-collapse: collapse;
        }

        @media only screen and (max-width: 640px) {
            body[yahoo] .deviceWidth {
                width: 440px !important;
                padding: 0;
            }

            body[yahoo] .center {
                text-align: center !important;
            }
        }

        @media only screen and (max-width: 479px) {
            body[yahoo] .deviceWidth {
                width: 280px !important;
                padding: 0;
            }

            body[yahoo] .center {
                text-align: center !important;
            }
        }
    </style>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" yahoo="fix"
    style="font-family: Arial, Helvetica, sans-serif">

    <!-- Wrapper -->
    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
        <tr>
            <td width="100%" valign="top">

                <!--Start Header-->
                <table width="700" bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" align="center"
                    class="deviceWidth">
                    <tr>
                        <td style="padding: 6px 0px 0px">
                            <table width="650" border="0" cellpadding="0" cellspacing="0" align="center"
                                class="deviceWidth">
                                <tr>
                                    <td width="100%">
                                        <!--Start logo-->
                                        <table border="0" cellpadding="0" cellspacing="0" align="left"
                                            class="deviceWidth">
                                            <tr>
                                                <td class="center" style="padding: 20px 0px 10px 0px">
                                                    <a href="{{ URL::to('/') }}" target="_blank"><img
                                                            src="{{ asset('img/logo1-default.png') }}"
                                                            height="50px;"></a>
                                                </td>
                                            </tr>
                                        </table><!--End logo-->
                                        <!--Start nav-->
                                        <table border="0" cellpadding="0" cellspacing="0" align="right"
                                            class="deviceWidth">
                                            <tr>
                                                <td class="center"
                                                    style="font-size: 13px; color: #272727; font-weight: light; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 0px 10px 0px;">
                                                    <a href="{{ URL::to('/') }}" target="_blank"
                                                        style="text-decoration: none; color: #3b3b3b;">92 Agents</a>
                                                </td>
                                            </tr>
                                        </table><!--End nav-->
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <!--End Header-->

                <!--Start Top Block-->
                <table width="100%" bgcolor="#74C52C" border="0" cellpadding="0" cellspacing="0" align="center"
                    class="deviceWidth">
                    <tr>
                        <td>
                            <table width="700" bgcolor="#74C52C" border="0" cellpadding="0" cellspacing="0"
                                align="center" class="deviceWidth">
                                <tr>
                                    <td width="100%">
                                        <!--Left box-->
                                        <table width="50%" border="0" cellpadding="0" cellspacing="0"
                                            class="deviceWidth">
                                            <tr>
                                                <td valign="middle">
                                                    <table border="0" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td class="center"
                                                                style="font-size: 16px; color: #ffffff; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 50px 0px 0 20px; ">
                                                                {{ $title }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="center"
                                                                style="font-size: 12px; color: #ffffff; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px ; ">
                                                                {{ $body }}
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table><!--End Left box-->
                                        <!-- Right box  -->
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <!--End Top Block-->
    </table>
    <!-- End Middle Block -->

    <!-- Footer -->
    <table width="700" bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" align="center"
        class="deviceWidth">
        <tr>
            <td>
                <table width="700" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                    <tr>
                        <td class="center"
                            style="font-size: 12px; color: #687074; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 20px; vertical-align: middle; padding: 30px 10px 0px; ">
                            Developed by <a href="http://cyberforttech.com" target="_blank">Cyber Fort Technologies</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="center"
                            style="font-size: 12px; color: #687074; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 20px; vertical-align: middle; padding: 10px 50px 30px; ">
                            Copyright © 92 Agents 2014
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--End Footer-->

    <div style="height:15px">&nbsp;</div><!-- divider -->

    </td>
    </tr>
    </table>
    <!-- End Wrapper -->
</body>

</html>
