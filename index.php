<?php
include 'db.php';
$result = $db->query("SELECT * FROM submissions");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Submission Review Demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-ZNPWSGR961"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-ZNPWSGR961');
    </script>
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="text-center mb-4">Submission Review System</h1>

        <div class="row g-4">
            <?php while($row = $result->fetch_assoc()): ?>
            <div class="col-md-4">
                <div class="card shadow-sm" data-id="<?= $row['id'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
                        <p class="card-text">
                            <span class="badge bg-<?php
                                echo match($row['status']) {
                                    'Approved' => 'success',
                                    'Rejected' => 'danger',
                                    default => 'secondary'
                                };
                            ?> status">
                                <?= htmlspecialchars($row['status']) ?>
                            </span>
                        </p>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-outline-success btn-sm approve">
                                <i class="fas fa-check"></i> Approve
                            </button>
                            <button class="btn btn-outline-danger btn-sm reject">
                                <i class="fas fa-times"></i> Reject
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
        $('button').click(function () {
            const card = $(this).closest('.card');
            const id = card.data('id');
            const status = $(this).hasClass('approve') ? 'Approved' : 'Rejected';

            $.post('update_status.php', { id, status }, () => {
                const badge = card.find('.status');
                badge.text(status);
                badge
                    .removeClass('bg-success bg-danger bg-secondary')
                    .addClass(status === 'Approved' ? 'bg-success' : 'bg-danger');
            });
        });
    </script>
</body>
</html>
