<?php
$lang->order->common  = 'Order';

$lang->order->id             = 'ID';
$lang->order->productInfo    = 'Products';
$lang->order->account        = 'Account';
$lang->order->address        = 'Address';
$lang->order->price          = 'Price';
$lang->order->count          = 'count';
$lang->order->amount         = 'Amount';
$lang->order->sn             = 'Payment Number';
$lang->order->payStatus      = 'Pay Status';
$lang->order->paidDate       = 'Paid Time';
$lang->order->deliveryStatus = 'Delivery Status';
$lang->order->deliveriedDate = 'Deliveried Time';
$lang->order->confirmedDate  = 'Time of receipt';
$lang->order->payment        = 'Transaction Mode';
$lang->order->createdDate    = 'Order time';
$lang->order->express        = 'Courier company';
$lang->order->waybill        = 'Waybill number';
$lang->order->expressInfo    = 'Express information';
$lang->order->receiver       = 'Receiver';
$lang->order->noRecord       = 'No record';
$lang->order->status         = 'Status';

$lang->order->admin          = 'Admin Orders';
$lang->order->setting        = 'Settings';
$lang->order->browse         = 'My Orders';
$lang->order->bought         = 'Browse bought producs';
$lang->order->createdSuccess = 'Order created successfully！';
$lang->order->paidSuccess    = 'Order paid successfully!';
$lang->order->submit         = 'Submit order';
$lang->order->cancel         = 'Cancel';
$lang->order->pay            = 'Pay';
<<<<<<< HEAD
$lang->order->goToPay        = 'To pay';
=======
$lang->order->goToPay        = 'Please complete the payment.';
>>>>>>> c73775486ee30d2d16f52c9c318ca6d2fe679f66
$lang->order->return         = 'Receive payment';
$lang->order->delivery       = 'delivery';
$lang->order->finish         = 'finish';
$lang->order->confirm        = 'Confirm order';
$lang->order->selectProducts = "<strong class='text-danger'>%s</strong> products selected, ";
$lang->order->totalToPay     = "cost：<strong id='amount' class='text-danger'>%s</strong>";
$lang->order->payInfo        = "Order from %s for %s";
$lang->order->goToBank       = "Please pay your order online.";
$lang->order->track          = 'Logistics tracking';
$lang->order->life           = 'order life';
$lang->order->days           = 'Days';
$lang->order->deliveryInfo   = 'Delivery Information';
$lang->order->backToCart     = 'Back to cart for change';
$lang->order->paid           = 'I have paid';

$lang->order->confirmLimit         = 'confirm delivery in';
$lang->order->confirmReceived      = 'Confirm Received';
$lang->order->deliveryConfirmed    = 'Your order delivery is received';
$lang->order->confirmWarning       = "<span class='text-danger'>Make sure you have received good.</span>";
$lang->order->cancelWarning        = "Confirm to cancel this order?";
$lang->order->cancelSuccess        = "order successsfully canceled";
$lang->order->paymentRequired      = 'At least one mode required';
$lang->order->confirmLimitRequired = 'You should set a  expiry dates of delivery receiving';
$lang->order->finishWarning        = "<span class='text-danger'>Make sure to finish this order ?</span>";
$lang->order->noProducts           = "No products in order";
$lang->order->lowStocks            = "<strong>%s</strong>Inventory shortage ";

$lang->order->alipayPid = 'Partner ID';
$lang->order->alipayKey = 'Partner KEY';
$lang->order->alipayEmail = 'Alipay Email';

$lang->order->placeholder = new stdclass();
$lang->order->placeholder->pid = 'Corporate identity to ID, 16 pure number begin with 2088.';
$lang->order->placeholder->key = 'Security checking code, 32 characters to numbers and letters.';
$lang->order->placeholder->email = 'Alipay email';

$lang->order->paymentList = array();
$lang->order->paymentList['alipay'] = 'Alipay payment';
$lang->order->paymentList['COD']    = 'Cash on delivery';

$lang->order->statusList = array();
$lang->order->statusList['not_paid']  = 'not paid';
$lang->order->statusList['paid']      = 'paid';
$lang->order->statusList['not_send']  = 'not send';
$lang->order->statusList['send']      = 'send';
$lang->order->statusList['confirmed'] = 'received';
$lang->order->statusList['normal']    = 'going';
$lang->order->statusList['finished']  = 'finished';
$lang->order->statusList['canceled']  = 'canceled';
