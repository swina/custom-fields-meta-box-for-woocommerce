# Custom Fields Meta Box for Woocommerce (beta 1.0.0)
Custom Fields MetaBox for Woocommerce is a Wordpress plugin to add custom rich-text fields to Woocommerce products.

**Warning this is as beta version not yet available on worpress plugin website. Use on a local development environment**

## What is Custom Fields MetaBox for Woocommerce?

Custom Fields MetaBox for Woocommerce is a useful plugin to add custom text fields to Woocommerce products.

## Features

- Create/Disable/Delete custom rich-text fields for Woocommerce products (simple/variable/grouped)
- Create a custom tab in the single product page for your custom fields or use the default description tab
- Add custom fields to the meta section of the single product page
- Order your custom fields with a simple drag&drop
- Empty fields not saved to database
- Easy import custom fields from external source using Woocommerce import features (see below for more explanation)
- Optimize DB option for better performance

## How it works?

With Custom Fields MetaBox you can define as many fields you want. 
Once you have defined your custom fields, they will be available int the product edit page, where you can input your data.
You can input data using the integrated wysiwyg editor so you can insert media files and so on.

Only fields with a value will be saved to database. 

After editing your Custom Fields for the product they will be displayed in the product single page of your shop. 
You can decide if you custom fields have to be added to the description tab or in a new tab with a custom name. 
This options are available in the Custom Fields Metabox Settings. 

Add custom fields to the single page meta section, setting the flag Product Page Meta to checked. 
Define your custom fields order dragging the custom fields rows to meet your needs.

## Import and Optimize DB

You can import your custom fields using the Woocommerce Import feature. 
Your CSV File only needs a column name heading for each custom field in the following format: <code>Meta: \_cf\_[custom_field_slug]</code> In the columns mapping select Import as meta

After importing data you should run the Optimize DB feature in order to clean all records with empty data.

## Premium Version?
Custom Tags Meta Box for Woocommerce is completely free. 

## Support
For any issue please submit here:
If you have any issue please open an issue here https://github.com/swina/custom-fields-meta-box-for-woocommerce/issues
