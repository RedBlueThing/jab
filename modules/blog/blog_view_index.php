<?php
$view['additional_head_tags'].="    <link rel=\"alternate\" type=\"application/rss+xml\" title=\"Get RSS 2.0 Feed\" href=\"".blog_link("/feed.rss")."\" />\n";
?>
<h1><?php echo htmlspecialchars($model['blog']['title']) ?></h1>
<h2><?php echo htmlspecialchars($model['blog']['description']) ?></h2>
<?php // ---------------- Command Bar----------------- ?>
<?php if (jabCanUser("post")): ?>
<p><a href="/<?php echo $model['blog']['routePrefix']?>/edit/new">New Post</a></p>
<hr/>
<?php endif ?>

<?php // ---------------- Article Loop----------------- ?>
<?php if (sizeof($model['articles'])): ?>
<div class="blog_index">
<?php foreach ($model['articles'] as $article): ?>

<?php // ---------------- Edit Commands ----------------- ?>
<?php if (jabCanUser("edit") || jabCanUser("delete")): ?>
<span style="float:right">
<small>
<?php if (jabCanUser("edit")): ?>
<a href="/<?php echo $model['blog']['routePrefix']?>/edit/<?php echo $article->ID?>">[Edit]</a>
<?php endif; if (jabCanUser("delete")): ?>
<a href="/<?php echo $model['blog']['routePrefix']?>/delete/<?php echo $article->ID?>">[Delete]</a>
<?php endif; ?>
</small>
</span>
<?php endif ?>

<?php // ---------------- Article ----------------- ?>
<div class="blog_article">
<h2><?php echo $article->Title ?></h2>
<?php echo $article->Format() ?>
<p><small>Posted <?php echo date('l, jS F Y', $article->TimeStamp)." at ".date('h:i a', $article->TimeStamp)?></small></p>
<?php if ($model['blog']['enableComments']): ?>
<p><a href="<?php echo $article->FullUrl() ?>">Read or Leave Comments</a></p>
<?php else: ?>
<p><a href="<?php echo $article->FullUrl() ?>">Permalink</a></p>
<?php endif; ?>
</div>

<?php // ---------------- End of Article Loop ----------------- ?>
<?php endforeach; ?>
</div>
<?php else: ?>
<p>No more articles</p>
<?php endif; ?>


<?php // ---------------- Paging ----------------- ?>
<?php if (isset($model['prevpagelink'])):?>
<span style="float:left"><a href="<?php echo $model['prevpagelink']?>">&#171; Newer Articles</a></span>
<?php endif ?>
<?php if (isset($model['nextpagelink'])):?>
<span style="float:right"><a href="<?php echo $model['nextpagelink']?>">Older Articles &#187;</a></span>
<?php endif ?>
