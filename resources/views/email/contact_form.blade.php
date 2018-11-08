<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>{{ $form->full_name }} sent you a message!</title>
    </head>
    <body>
        <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">
            <tr>
                <td align="center" valign="top">
                    <table border="0" cellpadding="20" cellspacing="0" width="600" id="emailContainer">
                        <tr>
                            <td align="center" valign="top">
                                <p>{{ $form->full_name }} sent you a message!</p>
                                <table>
                                    <tr>
                                        <td>Full Name:</td>
                                        <td>{{ $form->full_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email:</td>
                                        <td>{{ $form->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone:</td>
                                        <td>{{ $form->phone ?? '(not provided)' }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" height="40" valign="middle">Message:</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">{!! nl2br(e($form->message)) !!}</td>
                                    </tr>
                                </table>
                                <p>If you'd like to respond, simply reply to this email.</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>
