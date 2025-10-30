// SkillSwap Common JavaScript
document.addEventListener('DOMContentLoaded', function () {
  
  // Form validation with image extension check
  const forms = document.querySelectorAll('.needs-validation');
  Array.prototype.slice.call(forms).forEach(function (form) {
    form.addEventListener('submit', function (event) {
      const fileInput = form.querySelector('input[type="file"]');
      let filesOk = true;
      
      if (fileInput && fileInput.files.length > 0) {
        filesOk = validateImageExtension(fileInput);
      }
      
      if (!form.checkValidity() || !filesOk) {
        event.preventDefault();
        event.stopPropagation();
      }
      
      form.classList.add('was-validated');
    }, false);
  });

  // Gallery modal for details.php
  const imageModal = document.getElementById('imageModal');
  if (imageModal) {
    imageModal.addEventListener('show.bs.modal', function (event) {
      const trigger = event.relatedTarget;
      if (!trigger) return;
      
      const imgSrc = trigger.getAttribute('data-img');
      const imgAlt = trigger.getAttribute('data-alt') || 'Skill image';
      const modalImg = document.getElementById('modalImage');
      const modalLabel = document.getElementById('imageModalLabel');
      
      if (modalImg) {
        modalImg.src = imgSrc;
        modalImg.alt = imgAlt;
      }
      if (modalLabel) {
        modalLabel.textContent = imgAlt;
      }
    });
  }

  // Gallery modal for gallery.php
  const galleryModal = document.getElementById('galleryModal');
  const galleryModalImage = document.getElementById('galleryModalImage');
  if (galleryModal && galleryModalImage) {
    const galleryImages = document.querySelectorAll('.gallery-img');
    galleryImages.forEach(img => {
      img.addEventListener('click', function() {
        galleryModalImage.src = this.src;
        galleryModalImage.alt = this.alt;
        const modal = new bootstrap.Modal(galleryModal);
        modal.show();
      });
    });
  }

  // Category filter for gallery.php (dropdown version)
  const categoryFilter = document.getElementById('categoryFilter');
  if (categoryFilter) {
    categoryFilter.addEventListener('change', function() {
      const category = this.value;
      const items = document.querySelectorAll('[data-category]');
      
      items.forEach(item => {
        const parentCol = item.closest('.col-md-3, .col-sm-6');
        if (category === 'all' || item.getAttribute('data-category') === category) {
          parentCol.style.display = 'block';
        } else {
          parentCol.style.display = 'none';
        }
      });
    });
  }

  // Delete confirmation (using JavaScript confirm instead of modal)
  const deleteBtn = document.getElementById('deleteBtn');
  if (deleteBtn) {
    deleteBtn.addEventListener('click', function(event) {
      if (!confirm('Are you sure you want to permanently delete this skill?')) {
        event.preventDefault();
      }
    });
  }
});

/**
 * Validate image file extension
 * Allowed: jpg, jpeg, png, gif, webp
 * 
 */
function validateImageExtension(inputEl) {
  const allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
  const filePath = inputEl.value || '';
  const feedback = document.getElementById('imageError');
  
  if (!filePath) return true; // Required attribute handles empty
  
  const ext = filePath.split('.').pop().toLowerCase();
  const ok = allowed.includes(ext);
  
  if (!ok) {
    if (feedback) {
      feedback.textContent = 'Invalid file type. Allowed: ' + allowed.join(', ');
    }
    inputEl.setCustomValidity('Invalid file type');
  } else {
    inputEl.setCustomValidity('');
  }
  
  return ok;
}

/**
 * Filter gallery by category
 * Used on gallery.php
 */
function filterGallery(category) {
  const items = document.querySelectorAll('[data-category]');
  
  items.forEach(item => {
    if (category === 'all' || item.getAttribute('data-category') === category) {
      item.style.display = 'block';
    } else {
      item.style.display = 'none';
    }
  });
}