document.addEventListener("DOMContentLoaded", function () {
    // Focus on error fields
    const errorsElement = document.getElementById('auth-errors');
    if (errorsElement) {
        const errors = JSON.parse(errorsElement.dataset.errors);
        if (errors.email) {
            const emailField = document.getElementById("email");
            emailField.focus();
            emailField.scrollIntoView({ behavior: 'smooth', block: 'center' });
        } else if (errors.password) {
            const passwordField = document.getElementById("password");
            passwordField.focus();
            passwordField.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }
    
    // Add interactive effects
    const formInputs = document.querySelectorAll('.form-control');
    formInputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'translateY(-2px)';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'translateY(0)';
        });
    });
    
    // Button ripple effect
    const button = document.querySelector('.btn-primary');
    if (button) {
        button.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('ripple');
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    }
    
    // Add ripple CSS
    const style = document.createElement('style');
    style.textContent = `
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: scale(0);
            animation: rippleAnimation 0.6s linear;
            pointer-events: none;
        }
        
        @keyframes rippleAnimation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
});
