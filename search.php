<script>
  const form = document.querySelector('.search-container form');
  form.addEventListener('submit', handleSearch);

  function handleSearch(event) {
    event.preventDefault(); // prevent the form from submitting normally
    const searchTerm = form.querySelector('input[name="search"]').value;
  }
</script>