<div id="social-container">
    <?php foreach($data['services'] as $service_name => $service): ?>
        <a href="<?php print $service['url']; ?>" class="button toggle">
            <i class="social-icon <?php print strtolower($service_name); ?>"></i>
            <?php print 'ادخل عن طريق'; ?>
        </a>
    <?php endforeach; ?>
</div>

<div id="remember-container" class="buttons">
    <a href="#" class="button toggle <?php if($data["remember"]): ?>button-pressed<?php endif; ?>">
        <i class="icon-check<?php if(!$data["remember"]): ?>-empty<?php endif; ?>"></i> <?php print T('Keep me logged in'); ?>
    </a>
</div>