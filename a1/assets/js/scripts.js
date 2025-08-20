// Common JS for SkillSwap
document.addEventListener('DOMContentLoaded', function () {
  // Gallery modal logic
  const imageModal = document.getElementById('imageModal');
  if (imageModal) {
    imageModal.addEventListener('show.bs.modal', function (event) {
      const trigger = event.relatedTarget;
      if (!trigger) return;
      const imgSrc = trigger.getAttribute('data-img');
      const imgAlt = trigger.getAttribute('data-alt') || 'Gallery image';
      const modalImg = document.getElementById('modalImage');
      const modalLabel = document.getElementById('imageModalLabel');
      if (modalImg) { modalImg.src = imgSrc; modalImg.alt = imgAlt; }
      if (modalLabel) { modalLabel.textContent = imgAlt; }
    });
  }

  // Bootstrap validation + image extension check for forms using .needs-validation
  const forms = document.querySelectorAll('.needs-validation');
  Array.prototype.slice.call(forms).forEach(function (form) {
    form.addEventListener('submit', function (event) {
      const fileInput = form.querySelector('input[type="file"]');
      let filesOk = true;
      if (fileInput) { filesOk = validateImageExtension(fileInput); }
      if (!form.checkValidity() || !filesOk) {
        event.preventDefault();
        event.stopPropagation();
      } else {
        // Demo only: show success modal instead of submitting
        event.preventDefault();
        const successModalEl = document.getElementById('successModal');
        if (successModalEl) {
          const modal = new bootstrap.Modal(successModalEl);
          modal.show();
        }
      }
      form.classList.add('was-validated');
    }, false);
  });
});

/**
 * Validate image extension for an <input type="file">.
 * Allowed: jpg, jpeg, png, gif, webp
 * Returns true if valid, false otherwise.
 */
function validateImageExtension(inputEl) {
  const allowed = ['jpg','jpeg','png','gif','webp'];
  const filePath = inputEl.value || '';
  const feedback = document.getElementById('imageError');
  if (!filePath) return false; // required attribute handles empty

  const ext = filePath.split('.').pop().toLowerCase();
  const ok = allowed.includes(ext);
  if (!ok) {
    if (feedback) feedback.textContent = 'Invalid file type. Allowed: ' + allowed.join(', ') + '.';
    inputEl.value = ''; // reset invalid file
  }
  return ok;
}