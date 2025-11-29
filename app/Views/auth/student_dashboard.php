<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h2>Welcome, <?= esc($session->get('user_name')) ?></h2>

    <!-- Alert placeholder -->
    <div id="alert-placeholder" class="mt-3"></div>

    <div class="mt-4">
        <h3>Enrolled Courses</h3>
        <ul id="enrolled-courses" class="list-group mb-4">
            <?php if(!empty($enrollments)): ?>
                <?php foreach($enrollments as $course): ?>
                    <li class="list-group-item"><?= esc($course['title']) ?></li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="list-group-item">No courses enrolled yet.</li>
            <?php endif; ?>
        </ul>

        <h3>Available Courses</h3>
        <ul id="available-courses" class="list-group">
            <?php if(!empty($courses)): ?>
                <?php foreach($courses as $course): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?= esc($course['title']) ?>
                        <button class="btn btn-primary btn-sm enroll-btn" data-id="<?= $course['id'] ?>">Enroll</button>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="list-group-item">No courses available.</li>
            <?php endif; ?>
        </ul>
    </div>
</div>

<script>
$(document).ready(function() {
    var csrfName = '<?= csrf_token() ?>';
    var csrfHash = '<?= csrf_hash() ?>';

    function showAlert(message, type = 'success') {
        var html = '<div class="alert alert-' + type + ' alert-dismissible fade show" role="alert">' +
                   message +
                   '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                   '</div>';
        $('#alert-placeholder').html(html);
    }

    $('.enroll-btn').click(function() {
        var btn = $(this);
        var course_id = btn.data('id');

        $.ajax({
            url: '<?= site_url('/course/enroll') ?>',
            type: 'POST',
            data: {
                course_id: course_id,
                [csrfName]: csrfHash
            },
            success: function(response) {
                if(response.message === 'Enrollment successful'){
                    // Move course to enrolled list
                    var title = btn.closest('li').contents().first().text().trim();
                    $('#enrolled-courses').append('<li class="list-group-item">' + title + '</li>');

                    // Remove course from available list
                    btn.closest('li').remove();

                    showAlert('Enrolled in "' + title + '" successfully!', 'success');
                } else {
                    showAlert(response.message, 'warning');
                }
            },
            error: function(xhr) {
                if(xhr.status === 401){
                    showAlert('Please log in to enroll.', 'danger');
                } else {
                    showAlert('An error occurred.', 'danger');
                }
            }
        });
    });
});
</script>

<!-- Bootstrap JS for alerts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
