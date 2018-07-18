<?php
$body_plain = "Thank you for your order. Your order number is {$_SESSION['order_id']}. All orders are processed on the next business day. You will be contacted in case of any delays.\n\n";

$body_html = file_get_contents('plain_header.html');
$body_html .=  '<p>Thank you for your order. Your order number is ' . $_SESSION['order_id'] . '. All orders are processed on the next business day. You will be contacted in case of any delays.</p>
<table border="0" cellspacing="3" cellpadding="3">
	<tr>
		<th align="center">Item</th>
		<th align="center">Quantity</th>
		<th align="right">Price</th>
		<th align="right">Subtotal</th>
	</tr>';

// Get the cart contents for the confirmation email:
$oid = $_SESSION['order_id'];
$total = $_SESSION['order_total'];

// Add the total:
$body_plain .= "Total: \$$total\n";
$body_html .= '<tr>
	<td colspan="2"> </td><th align="right">Total</th>
	<td align="right">$' . $total . '</td>
</tr>
';

// Complete the HTML body:
$body_html .= '</table></body></html>';

// Uses Composer to autoload the Zend Framework files:
require_once('./vendorZend/autoload.php');
// Create a new mail:

use Zend\Mail;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;

// Create the parts:

$html = new MimePart($body_html);
$html->type = "text/html";

$plain = new MimePart($body_plain);
$plain->type = "text/plain";

// Create the message:

$body = new MimeMessage();
$body->setParts(array($plain, $html));
 
// Establish the email parameters:

$mail = new Mail\Message();
$mail->setFrom('davestorkman@egret.tv');
$mail->addTo($_SESSION['email']);
$mail->setSubject("Order #{$_SESSION['order_id']} at the Coffee Site");
$mail->setEncoding("UTF-8");
$mail->setBody($body);
$mail->getHeaders()->get('content-type')->setType('multipart/alternative');
//echo $body_html;
//echo $body_plain; die();

// Send the email:

$transport = new Mail\Transport\Sendmail();
//$transport->send($mail);
