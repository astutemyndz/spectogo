<div id="main" class="content_section bg-secondary">
    <div class="blog-page">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4 class="text-center font-weight-bold mt-0">Blog Details</h4>
                    <p class="text-center mb-5"><?=$blog[0]['title']?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="blog-details-area">
                        <img src="<?=base_url('assets/images/blogImage/'.$blog[0]['image'])?>" class="img-fluid"/>
                        <ul>
                            <li>
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                <?=date_format(date_create($blog[0]['created_at']), 'j F, Y')?>
                            </li>
                            <li>
                                <i class="fa fa-comments-o" aria-hidden="true"></i>
                                <span class = "commentCount"><?=count($comments)?></span>
                            </li>
                        </ul>
                        <h3><?=$blog[0]['title']?></h3>
                        <?=$blog[0]['description']?>
                        <hr />
                        <div class="blog-comments-area">
                            <h3>Comment(<span class = "commentCount"><?=count($comments)?></span>)</h3>
                            <div class="commentDiv">
                                <?php if(!empty($comments)){ 
                                foreach($comments as $comment){ ?>
                                    <div class="media">
                                        <div class="name-icon">
                                            <h3><?=substr($comment->name, '0', '1')?></h3>
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mt-0"><?=$comment->name?></h5>
                                            <p><?=date_format(date_create($comment->created_at), 'j F, Y')?></p>
                                            <?=$comment->comment?>
                                        </div>
                                    </div>
                                <?php } } ?>
                            </div>
                            <div class="comment-form-area">
                                <h4>Leave a comment...</h4>
                                <p><?=$blog[0]['title']?></p>
                                <form class="comments-form" id="blogCommentForm">
                                    <input type="hidden" name="blogId" value="<?=$blog[0]['id']?>">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Name</label>
                                            <input type="text" class="form-control requiredCheck restrictSpecial" data-check="Name" name="commentName" placeholder="Your Name" value="<?php if($this->session->userdata('user')){ print $this->session->userdata('user')['name']; } ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Email</label>
                                            <input type="text" class="form-control requiredCheck" data-check="Email" name="commentEmail" placeholder="demo@email.com" value="<?php if($this->session->userdata('user')){ print $this->session->userdata('user')['email']; } ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress">Comments</label>
                                        <textarea rows="4" placeholder="comments..." data-check="Comment" name="commentDesc" id="commentDesc" class="requiredCheck"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary postCommentBtn">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <?php if(!empty($relatedBlogs)){ ?>
                        <div class="blog-side-details">
                            <h4>Latest Post</h4>
                            <?php foreach($relatedBlogs as $relatedBlog){ ?>
                            <div class="media">
                                <a href="<?=base_url('blog-details/'.$relatedBlog['slug'])?>">
                                    <img src="<?=base_url('assets/images/blogImage/'.$relatedBlog['image'])?>" class="img-fluid" alt="<?=$relatedBlog['title']?>">
                                </a>
                                <div class="media-body">
                                    <h5>
                                        <a href="<?=base_url('blog-details/'.$relatedBlog['slug'])?>">
                                        <?=substr($relatedBlog['title'], '0', '30')?>..
                                        </a>
                                    </h5>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <div class="blog-side-details newsletter-side">
                        <div class="newsletter-sub">
                            <h4>Join The Newsletter</h4>
                            <div class="input-group">
                                <input type="text" class="form-control" name="newsletterEmail" id="newsletterEmail" placeholder="Email">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <button type="button" id="newsletterPost">
                                            <i class="fa fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <p>There's something magical about a garden, whether you're growing vegetables.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script> page = 'blog-details'</script>