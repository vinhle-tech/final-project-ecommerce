// Update profile icon link based on presence of user_present cookie
(function(){
  // Prefer server-side decision. Fallback to cookie if fetch fails.
  const api = window.location.origin + '/final-project-ecommerce-main/auth/header.php';
  fetch(api, {credentials: 'include'})
    .then(r => r.json())
    .then(data => {
      if (!data || !data.href) return;
      const imgs = document.querySelectorAll('img');
      imgs.forEach(img => {
        if (img.src && img.src.indexOf('profile.png') !== -1) {
          const a = img.closest('a');
          if (a) a.href = data.href;
        }
      });
    })
    .catch(() => {
      // fallback: use cookie
      const v = document.cookie.match('(^|;)\\s*user_present\\s*=\\s*([^;]+)');
      if (!v) return;
      const imgs = document.querySelectorAll('img');
      imgs.forEach(img => {
        if (img.src && img.src.indexOf('profile.png') !== -1) {
          const a = img.closest('a');
          if (!a) return;
          a.href = '/final-project-ecommerce-main/pages/myAccount.php';
        }
      });
    });
})();
