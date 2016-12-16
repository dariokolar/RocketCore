<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
</head>
<body>
<style type="text/css" media="all">

    body,#bodyTable,#bodyCell{	height:100% !important;	margin:0;padding:0;	width:100% !important;		}
    table{			border-collapse:collapse;		}
    table,td{			mso-table-lspace:0pt;			mso-table-rspace:0pt;		}
    img{			-ms-interpolation-mode:bicubic;		}
    body,table,td,p,a,li,blockquote{	-ms-text-size-adjust:100%;	-webkit-text-size-adjust:100%;		}
    #bodyCell{			padding:20px;		}
    html,body, td, th{font-family: Arial, helvetica, sans-serif; font-size: 10pt; color: #353f47; line-height: 1.4em;}

</style>
<table cellspacing="0" cellpadding="20" border="0" width="600" style="margin: 1em auto; width: 600px; margin: 0 auto;">
    <tr>
        <td  style="font-family: Arial, helvetica, sans-serif; font-size: 10pt; color: #353f47; background: #F4F4F4;" bgcolor="#F4F4F4">
            <img src="<?php echo selfDomain()."/admin/img/dev.png"; ?>" height="100px" alt="" style="display:block;" title="" />
        </td>
    </tr>
    <tr>
        <td style="font-family: Arial, helvetica, sans-serif; font-size: 10pt; color: #353f47;">

            <?php echo $text; ?>

        </td>
    </tr>
    <tr>
        <td style="font-family: Arial, helvetica, sans-serif; font-size: 10pt; color: gray; background: #F4F4F4;" bgcolor="#F4F4F4">
            Automaticky odesláno <?php dateformat("now", "j.n.Y H:i"); ?>
        </td>
    </tr>
</table>
</body>
</html>