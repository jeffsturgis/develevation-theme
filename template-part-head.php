<?php $cat = get_queried_object(); ?>
<div class="content <?php echo $cat->slug; ?>">

    <header class="header">
      <div class="container">
        <div class="col-md-4"><a href="/blog/"><img src="/wp-content/uploads/2017/10/header-logo.svg"></a></div>
        <div class="col-md-8 text-right">
          <script>document.write('<a href="https://twitter.com/Develevation"><i class="fa fa-twitter" aria-hidden="true"></i></a>');</script>
          <a href="https://github.com/jeffsturgis" title="GitHub" target="_blank"><i class="fa fa-github" aria-hidden="true"></i></a>
          <a href="https://codepen.io/JeffSturgis/" title="CodePen" target="_blank"><i class="fa fa-codepen" aria-hidden="true"></i></a>
          <a href="/blog/" title="Blog" ><i class="fa fa-wordpress" aria-hidden="true"></i></a>
          <a href="https://cybertruckservices.com" target="_blank" title="CybertruckServices" style="display: none"><div style="width: 60px; height: 40px; float: right; background:url(/wp-content/uploads/2021/04/cybertruck-services-icon.svg);  background-size: cover; "></div></a>
        </div>
      </div>
    </header>
    <div id="main-body" class="container">
