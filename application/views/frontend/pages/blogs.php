<div id="main" class="content_section bg-secondary">
    <div class="blog-page">
   	    <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4 class="text-center font-weight-bold mt-0 mb-5">Blog Post</h4>
                    <!-- <p class="text-center mb-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p> -->
                </div>
            </div>
            <?php if(!empty($blogs)){ ?>
                <div class="card-columns blog-post">
                    <?php foreach($blogs as $blog){ ?>
                        <div class="card">
                            <a href="<?=base_url('blog-details/'.$blog['slug'])?>">
                                <img src="<?=base_url('assets/images/blogImage/'.$blog['image'])?>" class="card-img-top" alt="<?=$blog['title']?>">
                            </a>
                            <div class="card-body">
                                <ul>
                                    <li>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                        <?=date_format(date_create($blog['created_at']), 'j F, Y')?>
                                    </li>
                                    <li>
                                        <i class="fa fa-comments-o" aria-hidden="true"></i>
                                        <?=$blog['no_of_comments']?>
                                    </li>
                                </ul>
                                <h5 class="card-title">
                                    <a href="<?=base_url('blog-details/'.$blog['slug'])?>">
                                        <?=substr($blog['title'], '0', '60')?>....
                                    </a>
                                </h5>
                                <p class="card-text">
                                    <?=substr($blog['description'], '0', '130')?>...
                                </p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php }else{ ?>
                <div class="col-12 text-center"><h1>No Blogs Found !!!</h1></div>
            <?php } ?>
   	    </div>
   </div>
</div>
<script> page = 'blogs'</script>