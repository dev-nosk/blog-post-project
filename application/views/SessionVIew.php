<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Session Tabs</title>
  <!-- MDBootstrap CSS -->
  <link href="<?= base_url() ?>/assets/cdn/mdb.min.css" rel="stylesheet" />
</head>
<body class="bg-light">

<div class="container my-5">
  <h2 class="text-center mb-4">Session Data Tabs</h2>

  <?php $session_data = $this->session->userdata(); ?>

  <?php if (!empty($session_data)): ?>
    <!-- Tabs navs -->
    <ul class="nav nav-tabs mb-3" id="sessionTab" role="tablist">
      <?php $i = 0; foreach ($session_data as $key => $value): ?>
        <li class="nav-item" role="presentation">
          <a
            class="nav-link <?= $i === 0 ? 'active' : '' ?>"
            id="<?= $key ?>-tab"
            data-mdb-toggle="tab"
            href="#<?= $key ?>-content"
            role="tab"
            aria-controls="<?= $key ?>-content"
            aria-selected="<?= $i === 0 ? 'true' : 'false' ?>"
          >
            <?= ucfirst(htmlspecialchars($key)) ?>
          </a>
        </li>
      <?php $i++; endforeach; ?>
    </ul>

    <!-- Tabs content -->
    <div class="tab-content" id="sessionTabContent">
      <?php $j = 0; foreach ($session_data as $key => $value): ?>
  <div
    class="tab-pane fade <?= $j === 0 ? 'show active' : '' ?>"
    id="<?= $key ?>-content"
    role="tabpanel"
    aria-labelledby="<?= $key ?>-tab"
  >
    <div class="card shadow-sm mb-4">
      <div class="card-body">
        <h5 class="card-title"><?= ucfirst(htmlspecialchars($key)) ?> Value</h5>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Key</th>
              <th>Value</th>
            </tr>
          </thead>
          <tbody>
            <?php if (is_array($value) || is_object($value)): ?>
              <?php foreach ((array)$value as $subKey => $subVal): ?>
                <tr>
                  <td><?= htmlspecialchars($subKey) ?></td>
                  <td>
                    <?php 
                      if (is_array($subVal) || is_object($subVal)) {
                        echo '<pre>' . print_r($subVal, true) . '</pre>';
                      } else {
                        echo htmlspecialchars($subVal);
                      }
                    ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td><?= htmlspecialchars($key) ?></td>
                <td><?= htmlspecialchars($value) ?></td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
<?php $j++; endforeach; ?>

    </div>

  <?php else: ?>
    <div class="alert alert-warning text-center">No session data found.</div>
  <?php endif; ?>


</div>

<!-- MDBootstrap JS + dependencies -->
<script src="<?= base_url() ?>/assets/cdn/mdb.min.js"></script>
</body>
</html>
