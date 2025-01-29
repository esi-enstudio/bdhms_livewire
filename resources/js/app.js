import './bootstrap';
import 'preline';

// Re-initial Preline UI on every navigation
document.addEventListener('DOMContentLoaded', () => {
    window.HSStaticMethods.autoInit();
})
document.addEventListener('livewire:navigated', () => {
    window.HSStaticMethods.autoInit();
});

// Select, Deselect all rso
document.addEventListener('DOMContentLoaded', function () {
    // Find all buttons with IDs starting with "button-"
    const buttons = document.querySelectorAll('[id^="chkbtn-"]');

    buttons.forEach(button => {
        button.addEventListener('click', function () {
            // Get the checkbox ID by replacing "button-" with "checkbox-"
            const checkboxId = button.id.replace('chkbtn-', 'rsochk-');
            const checkbox = document.getElementById(checkboxId);

            // Toggle the checkbox
            if (checkbox) {
                checkbox.checked = !checkbox.checked;
                checkbox.dispatchEvent(new Event('change')); // Trigger Livewire change event
            }
        });
    });
});
