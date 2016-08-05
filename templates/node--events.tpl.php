<div class="row">
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-body">
        <h5><?php print t('When:'); ?></h5>
        <p>
          <?php print $event_date_range; ?><br/>
          <?php print $event_time_range; ?>
        </p>
        <h5><?php print t('Where:'); ?></h5>
        <p><?php print $event_location; ?></p>
      </div>
    </div>
  </div>
  <div class="col-md-8">
    <?php print $event_details; ?>
    <?php print $back_to_all_events; ?>
  </div>
</div>
