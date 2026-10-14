--
-- This patch speeds up the database for high amount of data
--

-- category_products: filter on categoryid, join on productid, sort by orderby (covering)
ALTER TABLE category_products
  ADD UNIQUE INDEX idx_cat_prod_order (categoryid, productid, orderby);

-- products: equality filters first, then the price range
ALTER TABLE products
  ADD INDEX idx_brand_status_price (brandid, status, price);

-- option_groups: join on productid + name, returns groupid without a table lookup
ALTER TABLE option_groups
  ADD INDEX idx_prod_name_group (productid, name, groupid);

-- options: join on groupid + name filter
ALTER TABLE options
  ADD INDEX idx_group_name (groupid, name);

ALTER TABLE featured_products
  ADD INDEX idx_cat_enabled_order (categoryid, enabled, orderby, productid);

ALTER TABLE option_groups
  ADD INDEX idx_prod_sort (productid, orderby, name, fullname, groupid);

ALTER TABLE options
  ADD INDEX idx_group_order_name (groupid, orderby, name);

ALTER TABLE products
  ADD INDEX idx_status_sales (status, sales_stats);

ALTER TABLE products
  ADD INDEX idx_status_views (status, views_stats);

ALTER TABLE products
  ADD INDEX idx_status_date (status, add_date);

ALTER TABLE category_banners
  ADD INDEX idx_cat_pos (categoryid, pos, bannerid);

ALTER TABLE testimonials
  ADD INDEX idx_status_tid (status, tid);

-- news: filter on active, read in newsid order
ALTER TABLE news
  ADD INDEX idx_active_newsid (active, newsid);

-- news_images: find each news item's images
ALTER TABLE news_images
  ADD INDEX idx_newsid (newsid);

ALTER TABLE blog
  ADD INDEX idx_active_blogid (active, blogid);

ALTER TABLE blog_images
  ADD INDEX idx_blogid (blogid);

-- check
ALTER TABLE category_products
  ADD INDEX idx_prod_cat (productid, categoryid);

ALTER TABLE products
  ADD FULLTEXT INDEX ft_search (name, descr, keywords);

ALTER TABLE variant_items
  ADD UNIQUE INDEX idx_variant_option (variantid, optionid);

ALTER TABLE variants
  ADD INDEX idx_productid (productid);

ALTER TABLE option_groups
  ADD INDEX idx_prod_variant_sort (productid, variant, orderby, name, fullname);

ALTER TABLE users
  ADD INDEX idx_membershipid (membershipid);

ALTER TABLE product_inventory
  ADD UNIQUE INDEX idx_prod_variant_wid (productid, variantid, wid);

ALTER TABLE wholesale_prices
  ADD INDEX idx_variant_member_qty (variantid, membershipid, quantity);

ALTER TABLE category_products
  ADD INDEX idx_prod_main_cat (productid, main, categoryid);

ALTER TABLE users
  ADD INDEX idx_type_status_names (usertype, status, firstname, lastname, email);

ALTER TABLE orders
  ADD INDEX idx_status_date (status, date);