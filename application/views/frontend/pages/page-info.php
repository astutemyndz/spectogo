<div id="main" class="content_section">
    <div class="bg-secondary">
        <div class="container">
            <div class="row d-flex justify-content-md-center pt-4 pb-4">
                <div class="col-lg-9 col-12">
                    <h4 class="font-weight-bold text-center mb-4"><?=$pageInfo['name']?></h4>
                    <h5 class="font-weight-bold text-center mb-3"><?=$pageInfo['title']?></h5>
                    <div class="text-center"><?=$pageInfo['description']?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white border-bottom pt-4 pb-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9 col-12">
                    <h5 class="font-weight-bold text-center mb-3">The Team @ <?=$webManage['contact_email']?></h5>
                    <p class="text-center text-color-1 text-color-11" style="font-size:14px;"><?=$webManage['contact_address']?></p>
                    <p class="text-center">
                        <h4 class="text-primary ml-2 mb-0 text-center font-weight-semibold d-flex justify-content-center align-items-center">
                            <i class="fa fa-phone bg-primary rounded-circle text-white mr-2" style="font-size: 14px;height:28px;width:28px;line-height:28px;" aria-hidden="true"></i>
                            <?=$webManage['contact_phone']?>
                        </h4>
                    </p> 
                </div>
            </div>
        </div>
    </div>
</div>
<script> page = 'page-info'</script>