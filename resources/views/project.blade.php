@include('header')
<div class="container">
    @foreach ($project as $pr)
    <div class="project-image">
        <img src="<?php echo $pr->image_url; ?>">
        <?php $i = 1; ?>
        <?php foreach ($discussions as $discussion): ?>
        <div class="project-discussion" style="left:<?php echo $discussion->pos_left; ?>px; top:<?php echo $discussion->pos_top; ?>px;"><?php echo $i++; ?></div>
        <?php endforeach; ?>
    </div>
    @endforeach
</div>
@include('footer')