<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/jsbarcode/3.6.0/JsBarcode.all.min.js"></script>
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=VT323&display=swap" rel="stylesheet">

</head>

<style>
    * {
        margin: 0;
        box-sizing: border-box;
        font-family: "VT323", monospace;
        color: #1f1f1f;
    }


    .container {
        background: rgba(106, 92, 92, 1);
        padding: 20px 10px;
        min-height: 100vh;
    }
    
    .bold {
        font-weight: bold;
    }

    .center {
        text-align: center;
    }

    .receipt {
        width: 300px;
        height: 100%;
        background: #fff;
        margin: 0 auto;
        box-shadow: 5px 5px 19px rgba(0, 0, 0, 0.58);
        padding: 10px;
    }

    .logo {
        text-align: center;
        padding: 20px;
    }

    .address {
        text-align: left;
        margin-bottom: 10px;
    }

    .cashier {
        text-align: left;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .details {
        display: flex;
        justify-content: space-between;
        margin: 0 0 0;
    }

    .transactionDetails {
        display: flex;
        justify-content: space-between;
        margin: 0 10px 0;
    }

    .transactionDetails .detail {
        text-transform: uppercase;
        margin-bottom: 0;
    }

    .transactionDetails .quantity {
        text-transform: uppercase;
        display: flex;
        justify-content: space-between;
        margin: 0 10px;
    }

    .centerItem {
        display: flex;
        justify-content: center;
        margin-bottom: 8px;
    }

    .survey {
        text-align: center;
        margin-top: 30px;
        margin-bottom: 12px;
        font-size: 22px;
    }

    .survey .surveyID {
        font-size: 15px;
        margin-top: 40px;
    }

    .paymentDetails {
        display: flex;
        justify-content: space-between;
        margin: 0 auto;
        width: 165px;
    }

    .creditDetails {
        margin: 10px auto;
        width: 230px;
        font-size: 14px;
        text-transform: uppercase;
    }

    .receiptBarcode {
        margin: 10px 10px;
        text-align: center;
    }

    .returnPolicy {
        text-align: center;
        font-size: 14px;
        margin: 10px 20px;
        width: 250px;
        display: flex;
        justify-content: space-between;
    }

    .returnPolicy .detail {
        text-align: left;
        font-size: 15px;
        margin: 10PX 20px;
        width: 200px;
        display: flex;
        justify-content: space-between;
    }


    .coupons {
        margin-top: 20px;
    }

    .tripSummary {
        margin: auto;
        width: 255px;
    }

    .tripSummary .item {
        display: flex;
        justify-content: space-between;
        margin: auto;
        width: 220px;
    }

    .feedback {
        margin: 20px auto;
    }

    .feedback h3.clickBait {
        font-size: 30px;
        font-weight: bold;
        text-align: center;
        margin: 10px 0;
    }

    .feedback h4.web {
        font-size: 20px;
        font-weight: bold;
        text-align: center;
        margin: 10px 0;
    }

    .break {
        text-align: center;
        font-size: 18px;
        font-weight: bold;
        margin: 10px 0;
    }

    .couponContainer {
        border-top: 1px dashed #1f1f1f;
        margin-bottom: 20px;
    }

    .couponContainer .discount {
        font-size: 35px;
        text-align: center;
        margin-bottom: 10px;
    }

    .couponContainer .discountDetails {
        font-size: 20px;
        text-align: center;
        margin-bottom: 15px;
    }

    .couponContainer .legal {
        font-size: 12px;
        margin-bottom: 12px;
    }

    .couponContainer .barcodeID {
        margin-bottom: 8px;
    }

    .couponContainer .expiration {
        display: flex;
        justify-content: space-between;
        margin: 10px;
    }

    .couponContainer .couponBottom {
        font-size: 13px;
        text-align: center;
    }

    .center-button{
        margin: 0;
        top: 50%;
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
    }
</style>

<body>

    <div class="container">
        <div class="receipt">
            <h1 class="logo">DOINDIE</h1>
            
            <div class="address">
                It's Ordered!
                <div class="address">Hi <?= $data['user_info']['username'] ?>, </div>
                <div class="address">Thank you for your order, we hope you enjoyed shopping with us.</div>
                <div class="details">
                    <div class="detail">DOP: <?= $data['dop']?></div>
                </div>
                <div class="break">**************************************</div>
                <div class="cashier">
                    Where:
                </div>
                <div class="transactionDetails">
                    <div class="detail"><?= $data['address'] ?></div>
                </div>
                <div class="cashier">
                    When:
                </div>
                <div class="transactionDetails">
                    <div class="detail">Delivered within 3 to 4 business days.</div>
                </div>
                <div class="break">**************************************</div>
                <div class="cashier">
                    What you Ordered:
                </div>

                <?php foreach($data['selected_carts'] as $cart):?>
                    
                    <div class="transactionDetails">
                        <div class="detail"><?= $cart['quantity']?> <?= $cart['title']?></div>
                        <div class="quantity"> ₱ <?= number_format($cart['price'], 2, '.', ',')?></div>
                    </div>
                
                <?php endforeach; ?>
                
                <div class="break">**************************************</div>
                <div class="paymentDetails">
                    <div class="detail">PAYMENT METHOD</div>
                    <div class="detail">GCash</div>
                </div>
                <div class="paymentDetails">
                    <div class="detail">SUBTOTAL</div>
                    <div class="detail"> ₱ <?= $data['subtotal']?></div>
                </div>

                <?php if($data['voucher_code'] == 'None'):?>
                    <div class="paymentDetails">
                        <div class="detail">VOUCHER</div>
                        <div class="detail"><?= $data['voucher_code']?></div>
                    </div>
                <?php else: ?>
                    <div class="paymentDetails">
                        <div class="detail">VOUCHER</div>
                        <div class="detail"><?= $data['voucher_code']?></div>
                    </div>
                    <div class="paymentDetails">
                        <div class="detail">DISCOUNT</div>
                        <div class="detail"><?= $data['voucher_desc']?></div>
                    </div>
                <?php endif; ?>
                
                <div class="paymentDetails bold">
                    <div class="detail">TOTAL</div>
                    <div class="detail"> ₱ <?= $data['total']?></div>
                </div>
                <div class="receiptBarcode">
                    <canvas style="max-width: 100%; min-width: 100%; min-height: 60px; max-height: 60px;" class="barcode" id="barcode-holder" code="<?= $data['order_id']?>"></canvas>
                    <?= $data['formatted_order_id']?>
                </div>
                <div class="returnPolicy bold">
                    A copy of receipt is sent to <?= $data['user_info']['email'] ?>.
                </div>
                <div class="feedback">
                    <div class="break">**************************************</div>
                    <p class="center">
                        KEEP MAKING AWESOME STUFF!
                    </p>
                    <h3 class="clickBait">THANK YOU</h3>
                    <h4 class="web">www.DOINDIE.com</h4>
                    <div class="break">**************************************</div>
                    <div class="center">
                    <button onclick="window.location='<?php echo BASEURL; ?>'">GO TO HOME</button>
                    </div>
                </div>
            </div>
            <!--       end coupon -->
        </div>
    </div>
    </div>

    <script>
        function generateBarcode() {
            let code = document.getElementById('barcode-holder').getAttribute('code');
            JsBarcode("#barcode-holder", code, {
                width: 2.5,
                height: 50,
                displayValue: false
            });
        }

        generateBarcode();
    </script>

</body>

</html>