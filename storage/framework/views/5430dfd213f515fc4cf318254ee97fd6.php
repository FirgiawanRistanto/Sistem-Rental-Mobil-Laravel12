    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <button class="btn sidebar-toggle me-3" type="button" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <a class="navbar-brand" href="<?php echo e(route('admin.dashboard')); ?>">
                <i class="fas fa-car me-2"></i>
                Admin Rental Mobil
            </a>
            <div class="ms-auto d-flex align-items-center">
                
                <div class="dropdown me-3">
                    <button class="btn dropdown-toggle position-relative" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-bell"></i>
                        <?php if($unreadNotifications->count() > 0): ?>
                            <span id="notification-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?php echo e($unreadNotifications->count()); ?>

                            </span>
                        <?php endif; ?>
                    </button>
                    <ul id="notification-dropdown-list" class="dropdown-menu dropdown-menu-end">
                        <?php $__empty_1 = true; $__currentLoopData = $unreadNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li>
                                <a class="dropdown-item notification-item" href="<?php echo e($notification->data['url']); ?>" data-notification-id="<?php echo e($notification->id); ?>">
                                    <?php echo e($notification->data['message']); ?>

                                </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <li><a class="dropdown-item" href="#">Tidak ada notifikasi baru</a></li>
                        <?php endif; ?>
                    </ul>
                </div>

                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle me-1"></i>
                        <?php echo e(Auth::user()->name ?? 'Admin'); ?>

                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i>Keluar
                            </a>
                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                <?php echo csrf_field(); ?>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        console.log('DOMContentLoaded fired.');
        const notificationDropdownList = document.getElementById('notification-dropdown-list');
        console.log('notificationDropdownList element:', notificationDropdownList);
        const notificationBadge = document.getElementById('notification-badge');

        if (notificationDropdownList) {
            notificationDropdownList.addEventListener('click', function (event) {
                console.log('Click event on dropdown list detected.');
                const clickedItem = event.target.closest('.notification-item');
                console.log('clickedItem found by closest:', clickedItem);
                if (clickedItem) {
                    console.log('Notification item found via closest! Preventing default...');
                    event.preventDefault(); // Prevent default link behavior

                    const notificationId = clickedItem.dataset.notificationId;
                    const notificationUrl = clickedItem.getAttribute('href');
                    const listItem = clickedItem.closest('li');

                    const markAsReadUrl = `<?php echo e(route('admin.notifications.markAsRead', ['notification' => '__NOTIFICATION_ID__'])); ?>`;

                    fetch(markAsReadUrl.replace('__NOTIFICATION_ID__', notificationId), {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ notification_id: notificationId })
                    })
                    .then(response => {
                        console.log('Raw Fetch response:', response);
                        if (!response.ok) {
                            // If response is not OK (e.g., 401, 403, 500), log the raw text
                            response.text().then(text => console.error('Server error response text:', text));
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Parsed JSON data:', data);
                        if (data.message === 'Notification marked as read') {
                            if (listItem) {
                                listItem.remove();
                            }

                            if (notificationBadge) {
                                let currentCount = parseInt(notificationBadge.textContent);
                                if (!isNaN(currentCount) && currentCount > 0) {
                                    notificationBadge.textContent = currentCount - 1;
                                    if (currentCount - 1 === 0) {
                                        notificationBadge.style.display = 'none';
                                    }
                                }
                            }

                            window.location.href = notificationUrl;
                        } else {
                            console.error('Unexpected response message:', data.message);
                            window.location.href = notificationUrl;
                        }
                    })
                    .catch(error => {
                        console.error('Error marking notification as read:', error);
                        window.location.href = notificationUrl;
                    });
                }
            });
        }
    });
</script><?php /**PATH D:\Kuliah\xampp8\htdocs\rentalMobil\resources\views/layouts/_partials/navbar.blade.php ENDPATH**/ ?>