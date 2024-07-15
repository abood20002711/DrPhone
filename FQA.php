<?php
session_start();
if (isset($_SESSION['Homepage'])) {
    $PageTilte = "FQA";
    include "init.php";
    include "navbar.php";

} else {
    header('location:index.php');
}
?>
<div class="site-content">
  <div class="FQA">
    <div class="container">
      <div class="FQA-head">
        <h1>Frequently Asked Questions</h1>
        <p>This Agreement was last modified on 18th February 2016</p>
      </div>
      <div class="FQA-content">
        <div class="content-head">
          <h5>Shipping Information</h5>
        </div>
        <div class="content-body">
          <div class="row">
            <div class="col-lg-6 col-sm-12">
              <div class="content">
                <h3>What Shipping Methods Are Available?</h3>
                <p>At DrPhone, we offer a variety of shipping methods to accommodate the different needs and preferences of our customers. Here are the shipping methods available:</p>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12">
              <div class="content">
                <h3>How Long Will it Take To Get My Package?</h3>
                <p>The estimated delivery time for your package depends on various factors, including the shipping method selected, your location, and the destination of the package. Here are some general guidelines for estimating delivery times:</p>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12">
              <div class="content">
                <h3>How Do I Track My Order?</h3>
                <p>Please note that the tracking information may not be immediately available after placing your order. It can take some time for the shipping carrier to update their system and provide accurate tracking details. If you are unable to track your order immediately, wait for a few hours or up to a day and try again.</p>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12">
              <div class="content">
                <h3>Do I Need A Account To Place Order?</h3>
                <p>Having an account is necessary to place an order on our website. By creating an account, you can easily manage your orders, track their status, and access your order history.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="secound-FQA">
    <div class="container">
      <div class="FQA-head">
        <h1>FAQ Second Version</h1>
      </div>
      <div class="FQA-content">
        <div class="row">
          <div class="col col-lg-12">
            <ul class="arrow">
              <li>
                <input type="checkbox" checked>
                <i></i>
                <h2>What Shipping Methods Are Available?</h2>
                <p>Standard Shipping: This is our standard shipping method that provides reliable and cost-effective delivery for your orders. The estimated delivery time for standard shipping varies depending on your location and the destination of the package. It is a great option for customers who prioritize affordability and don't require expedited delivery.
<br>
Express Shipping: For customers who need their orders to be delivered quickly, we offer express shipping services. With express shipping, your package will be prioritized and delivered within a shorter timeframe compared to standard shipping. This option is ideal for time-sensitive orders or when you want to receive your items as soon as possible.</p>
              </li>
              <li>
                <input type="checkbox" checked>
                <i></i>
                <h2>How Long Will it Take To Get My Package?</h2>
                <p>
                    Standard Shipping: The delivery time for standard shipping typically ranges from a few days to a couple of weeks, depending on your location and the distance to the destination. This is a cost-effective option for customers who are not in a rush to receive their package.
                        <br>
                    Express Shipping: Express shipping offers faster delivery compared to standard shipping. The delivery time for express shipping is usually within a few business days, with some services guaranteeing delivery within a specific timeframe, such as 1-2 days. Express shipping is ideal when you need your package to arrive quickly.
                </p>
              </li>
              <li>
                <input type="checkbox" checked>
                <i></i>
                <h2>How Do I Track My Order?</h2>
                <p>
                    Locate your order number: You should have received an order confirmation email or a confirmation page after placing your order. Look for the order number in that communication.
                    <br>
                    Visit the tracking page: Go to our website and find the "Order Tracking" or "Track Your Order" page. It is usually located in the customer service section or the footer of the website.
                    <br>
                    Enter your order number: On the tracking page, enter your order number in the designated field. Make sure to enter the number correctly to avoid any errors.
                </p>
              </li>
              <li>
                <input type="checkbox" checked>
                <i></i>
                <h2>How Do I Place an Order?</h2>
                <p>
                    Identify the product or service: Decide what item or service you want to purchase. Ensure you have the necessary information, such as the product name, model number, or any specific details.
                    <br>
                    Find a seller or supplier: Look for a reputable seller or supplier that offers the product or service you want. This can be done through online marketplaces, official websites, local stores, or by contacting the company directly.
                    <br>
                    Contact the seller: Reach out to the seller using the preferred method of communication they provide. This can be through phone, email, live chat, or an online order form. Provide all the necessary details about the product or service you want to order.
                </p>
             </li>
              <li>
                <input type="checkbox" checked>
                <i></i>
                <h2>How Should I to Contact if I Have Any Queries?</h2>
                <p>Phone: Look for a customer service or helpline number provided by the seller. You can call them directly and speak to a representative to address your queries. Phone calls often allow for immediate interaction and clarification.
                    <br>
                Email: Send an email to the seller's customer support or sales team. Make sure to provide detailed information about your query in a clear and concise manner. This method is useful when you prefer written communication or need to attach supporting documents or screenshots</p>
              </li>
              <li>
                <input type="checkbox" checked>
                <i></i>
                <h2>Do I Need an Account to Place an Order?</h2>
                <p>Having an account is necessary to place an order on our website. By creating an account, you can easily manage your orders, track their status, and access your order history.</p>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

     
<?php
      include "HomePageFooter.php";
      include $tpl . "footer.php";
?>