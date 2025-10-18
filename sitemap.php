<?php
// إعداد الترويسة لتحديد نوع المحتوى كـ XML
header("Content-Type: text/xml; charset=utf-8");

// تحميل إعدادات ووردبريس للوصول لقواعد البيانات
require_once('wp-load.php');

// ترويسة XML
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset 
  xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
  xmlns:xhtml="http://www.w3.org/1999/xhtml">

<?php
// جلب كل المقالات والصفحات المنشورة
$args = array(
  'post_type'      => array('post', 'page'),
  'post_status'    => 'publish',
  'posts_per_page' => -1,
  'orderby'        => 'modified',
  'order'          => 'DESC'
);
$posts = get_posts($args);

// حلقة لإخراج كل رابط في ملف الـ sitemap
foreach ($posts as $post) {
  $post_url  = get_permalink($post->ID);
  $post_date = date('Y-m-d', strtotime($post->post_modified_gmt));
  ?>
  <url>
    <loc><?php echo htmlspecialchars($post_url); ?></loc>
    <lastmod><?php echo $post_date; ?></lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
  </url>
<?php } ?>

</urlset>

