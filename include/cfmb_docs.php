<h1>Custom Fields MetaBox for Woocommerce</h1>
<h2>Documentation</h2>
<h4>For updated documentation check <a href="https://github.com/swina/custom-fields-meta-box-for-woocommerce/wiki" target="_blank">here</a></h4>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="PR5979HT68HGN">
<input type="image" src="https://www.paypalobjects.com/it_IT/IT/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal è il metodo rapido e sicuro per pagare e farsi pagare online.">
<img alt="" border="0" src="https://www.paypalobjects.com/it_IT/i/scr/pixel.gif" width="1" height="1">
</form>
<h3>What is Custom Fields MetaBox for Woocommerce?</h3>
<p>Custom Fields MetaBox for Woocommerce is a free plugin to add custom text fields to Woocommerce products.</p>
<h3>Features</h3>
<ul>
  <li>- Create/Disable/Delete custom text fields for Woocommerce products </li>
  <li>- Create a custom tab in the single product page for your custom fields or add them to the description tab</li>
  <li>- Add custom fields to the meta section of the single product page</li>
  <li>- Order your custom fields with a simple drag&amp;drop</li>
  <li>- Empty fields not saved to database</li>
  <li>- Easy import custom fields from external source using Woocommerce import features</li>
  <li>- Optimize DB option for better performance</li>
</ul>

<h3>How it works?</h3>
<p>With Custom Fields MetaBox you can define as many fields you want. Once you have defined your custom fields, they will be available int the product edit page, where you can input your data. Only fields with a value will be saved to database.
  <br>
  After editing your Custom Fields for the product they will be displayed in the product single page of your shop.
  <br>
  You can decide if you custom fields have to be added to the description tab or in a new tab with a custom name. This options are available in the Custom Fields Metabox Settings.
  <br>
  You can also add custom fields to the single page meta section, setting the flag <code>Product Page Meta</code> to checked.
  <br>
  You can also define your output order dragging the custom fields rows to meet your needs.
</p>
<h3>Import and Optimize DB</h3>
<p>You can import your custom fields using the Woocommerce Import feature.
  <br>
  Your CSV File only needs a column name heading for each custom field in the following format:
  <code>Meta: _cf_[custom_field_slug]</code>
  In the columns mapping select <code>Import as meta</code>
</p>
<p>After importing data you should run the Optimize DB feature in order to clean all records with empty data.
</p>

<h3>Is there a Premium Version?</h3>
<p>Custom Fields Meta Box for Woocommerce is completely free.
</p>
<p>
  If you feel good with this plugin you can even donate some!
  <br>
  <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="PR5979HT68HGN">
<input type="image" src="https://www.paypalobjects.com/it_IT/IT/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal è il metodo rapido e sicuro per pagare e farsi pagare online.">
<img alt="" border="0" src="https://www.paypalobjects.com/it_IT/i/scr/pixel.gif" width="1" height="1">
</form>
</p>
<h3>Development Roadmap</h3>
<p>
<ul>
  <li>- create sets of common custom fields for specific products category (computer, electronic, etc.)</li>
  <li>- create CSV product import templates as sample</li>
</ul>

</p>
<?php
  include_once('cfmb_footer.php');
?>
