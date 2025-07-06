document.addEventListener('DOMContentLoaded', function () {
  const tempWrapper = document.getElementById('comentario-temp-wrapper');
  const embed = document.getElementById('comentario-app');

  // Find the <article> containing the post
  const articles = document.querySelectorAll('article');

  if (articles.length && tempWrapper && embed) {
    const postArticle = articles[0];
    // Insert just before the closing of </article>.
    postArticle.appendChild(embed);
    // Clean the temporary wrapper
    tempWrapper.remove();
  }
});
