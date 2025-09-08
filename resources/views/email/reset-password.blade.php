<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <td>
                    <table width="680" align="center" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td align="left" valign="top">
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="640">
                                        <tbody>
                                            <tr bgcolor="#fff">
                                                <td colspan="2"
                                                    style=" text-align: center; height:100px; vertical-align: middle; border-top: thin solid silver; border-left: thin solid silver; border-right: thin solid silver; ">
                                                    <img src="{{ $settings->logo ? config('app.default_site_url') . '/storage/' . $settings->logo : config('app.logo_full_path') }}
"
                                                        width="180px" class="" />
                                                </td>
                                            </tr>
                                            <tr bgcolor="#fb914b">
                                                <td colspan="2"
                                                    style=" text-align: center; height: 40px; vertical-align: middle;">
                                                    <span
                                                        style=" font-family: arial, sans-serif; font-size: 16px; text-transform: capitalize; line-height: 24px; color:#fff; font-weight: bold;">Reset
                                                        Password Notification</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"
                                                    style=" border-left: thin solid silver; border-right: thin solid silver; border-bottom: thin solid silver; ">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="3">
                                                                    <img src="img/transparen.gif" height="5" width="1"
                                                                        class="" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <img src="img/transparen.gif" height="5" width="1"
                                                                        class="" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="20"></td>
                                                                <td>
                                                                    <table width="100%" border="0" cellpadding="0"
                                                                        cellspacing="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>
                                                                                    <table width="100%" border="0"
                                                                                        cellpadding="0" cellspacing="0">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td width="50%">
                                                                                                    @if(!empty($name))
                                                                                                        <span style="font:16px Arial, sans-serif; font-weight:700; color:#222;">Hello {{ $name }}!</span>
                                                                                                    @endif
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>

                                                                                    <table width="100%" border="0"
                                                                                        cellpadding="0" cellspacing="0">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <img src="img/transparen.gif"
                                                                                                        height="5"
                                                                                                        width="1"
                                                                                                        class="" />
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <div>
                                                                                                        <span
                                                                                                            style=" font:14px Arial, sans-serif; line-height:20px; font-weight:600; color:#fb914b">
                                                                                                            You are
                                                                                                            receiving
                                                                                                            this email
                                                                                                            because we
                                                                                                            received a
                                                                                                            password
                                                                                                            reset
                                                                                                            request for
                                                                                                            your
                                                                                                            account..
                                                                                                        </span>
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <img src="img/transparen.gif"
                                                                                                        height="5"
                                                                                                        width="1"
                                                                                                        class="" />
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <img src="img/transparen.gif"
                                                                                                        height="5"
                                                                                                        width="1"
                                                                                                        class="" />
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td
                                                                                                    style="text-align: center;">
                                                                                                    <span><a target="_blank"
                                                                                                            style=" font:14px Arial, sans-serif; color: #333; line-height:20px; font-weight:600; color:#fff; background:#fb914b; padding: 10px 15px; text-decoration: none;"
                                                                                                            href="{{$url}}">Reset
                                                                                                            Password
                                                                                                            Notification</a></span>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <img src="img/transparen.gif"
                                                                                                        height="5"
                                                                                                        width="1"
                                                                                                        class="" />
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <img src="img/transparen.gif"
                                                                                                        height="5"
                                                                                                        width="1"
                                                                                                        class="" />
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <div>
                                                                                                        <span
                                                                                                            style=" display: block; font:14px Arial, sans-serif; color: #222; font-weight:500; line-height:20px; text-decoration: none;">
                                                                                                            If you're
                                                                                                            having
                                                                                                            trouble
                                                                                                            clicking the
                                                                                                            button, copy
                                                                                                            and paste
                                                                                                            the URL
                                                                                                            below into
                                                                                                            your web
                                                                                                            browser:
                                                                                                            <a target="_blank"
                                                                                                                style="color: #fb914b; font-weight:500;  word-break: break-all;"
                                                                                                                href="{{$url}}">{{$url}}</a>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <img src="img/transparen.gif"
                                                                                                        height="5"
                                                                                                        width="1"
                                                                                                        class="" />
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <img src="img/transparen.gif"
                                                                                                        height="5"
                                                                                                        width="1"
                                                                                                        class="" />
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <span
                                                                                                        style="font: 13px Arial, sans-serif;">This
                                                                                                        password reset
                                                                                                        link will expire
                                                                                                        in 60
                                                                                                        minutes..</span>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <img src="img/transparen.gif"
                                                                                                        height="5"
                                                                                                        width="1"
                                                                                                        class="" />
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                                <td width="20"></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="20"></td>
                                                                <td>
                                                                    <table width="100%" border="0" cellpadding="0"
                                                                        cellspacing="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>
                                                                                    <table width="100%" border="0"
                                                                                        cellpadding="0" cellspacing="0">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td width="50%">
                                                                                                    <span
                                                                                                        style="font: 13px Arial, sans-serif;">If
                                                                                                        you did not
                                                                                                        create an
                                                                                                        account, no
                                                                                                        further action
                                                                                                        is
                                                                                                        required.</span>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>

                                                                                    <table width="100%" border="0"
                                                                                        cellpadding="0" cellspacing="0">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <img src="img/transparen.gif"
                                                                                                        height="5"
                                                                                                        width="1"
                                                                                                        class="" />
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td width="50%">
                                                                                                    <span
                                                                                                        style="font: 13px Arial, sans-serif;">If
                                                                                                        you think the
                                                                                                        email is a spam,
                                                                                                        mark as spam or
                                                                                                        no further
                                                                                                        action is
                                                                                                        required.</span>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <img src="img/transparen.gif"
                                                                                                        height="5"
                                                                                                        width="1"
                                                                                                        class="" />
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td width="50%">
                                                                                                    <span
                                                                                                        style="font: 13px Arial, sans-serif; line-height: 24px;">Regards,
                                                                                                        <br>
                                                                                                        Jhingephul</span>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <img src="img/transparen.gif"
                                                                                                        height="13"
                                                                                                        width="1"
                                                                                                        class="" />
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                                <td width="20"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3"> <img src="img/transparen.gif"
                                                                        height="5" width="1" class="" /> </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                        style="background-color:#F0F0F0">
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <img src="img/transparen.gif" height="5" width="1"
                                                                        class="" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="50%" style="text-align: center;">
                                                                    <span
                                                                        style="font-size: 13px;color:#fb914b; font-weight: bold;">Copyright
                                                                        &copy; {{date('Y')}}. All right &reg; reserved
                                                                        by <a style="color:#fb914b; text-decoration: none;"
                                                                            href="{{route('frontend.index')}}"
                                                                            target="_blank">Jhingephul</a> .</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <img src="img/transparen.gif" height="5" width="1"
                                                                        class="" />
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <img src="img/transparen.gif" height="6" width="1" class="" />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>