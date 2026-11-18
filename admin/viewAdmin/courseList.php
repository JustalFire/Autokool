<?php
ob_start();
?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="font-weight-bold text-dark mb-0"><i class="fa fa-list text-primary"></i> <?php echo __('admin_course_list_title'); ?></h2>
    <a href="courseAdd" class="btn btn-success font-weight-bold"><i class="fa fa-plus"></i> <?php echo __('admin_btn_add_course'); ?></a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 50px;"><?php echo __('admin_th_id'); ?></th>
                        <th style="width: 80px;"><?php echo __('admin_th_picture'); ?></th>
                        <th><?php echo __('admin_th_title'); ?></th>
                        <th><?php echo __('admin_th_category'); ?></th>
                        <th><?php echo __('admin_th_price'); ?></th>
                        <th><?php echo __('admin_th_duration'); ?></th>
                        <th><?php echo __('admin_th_transmission'); ?></th>
                        <th style="width: 150px;" class="text-center"><?php echo __('admin_th_actions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($arr)): ?>
                        <?php foreach ($arr as $row): ?>
                            <tr>
                                <td class="font-weight-bold text-muted"><?php echo $row['id']; ?></td>
                                <td>
                                    <?php if (!empty($row['picture'])): ?>
                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($row['picture']); ?>" class="img-thumbnail" style="width: 65px; height: 45px; object-fit: cover;">
                                    <?php else: ?>
                                        <span class="badge badge-secondary"><?php echo __('admin_badge_none'); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <strong class="d-block text-dark"><?php echo htmlspecialchars(!empty($row['title_et']) ? $row['title_et'] : ($row['title'] ?? '')); ?></strong>
                                    <?php if (!empty($row['title_ru'])): ?>
                                        <small class="text-muted"><i class="fa fa-globe text-warning"></i> <?php echo htmlspecialchars($row['title_ru']); ?></small>
                                    <?php endif; ?>
                                </td>
                                <td><span class="badge badge-info"><?php echo htmlspecialchars($row['category_name'] ?? 'Määramata'); ?></span></td>
                                <td><strong class="text-primary"><?php echo number_format($row['price'], 2); ?> €</strong></td>
                                <td><small><?php echo htmlspecialchars(!empty($row['duration_et']) ? $row['duration_et'] : ($row['duration'] ?? '')); ?></small></td>
                                <td><span class="badge badge-light border"><?php echo htmlspecialchars(!empty($row['transmission_et']) ? $row['transmission_et'] : ($row['transmission'] ?? 'Manuaal')); ?></span></td>
                                <td class="text-center">
                                    <a href="courseEdit?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary mr-1" title="<?php echo __('admin_btn_edit'); ?>"><i class="fa fa-pencil"></i></a>
                                    <a href="courseDel?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" title="<?php echo __('admin_btn_delete'); ?>"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted"><?php echo __('admin_no_courses'); ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
include_once 'viewAdmin/templates/layout.php';
?>
