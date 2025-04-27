            document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search');
            const suggestionsBox = document.createElement('div');
            suggestionsBox.style.position = 'absolute';
            suggestionsBox.style.backgroundColor = 'white';
            suggestionsBox.style.border = '1px solid #ccc';
            suggestionsBox.style.zIndex = '1000';
            suggestionsBox.style.width = searchInput.offsetWidth + 'px';
            document.body.appendChild(suggestionsBox);

            function showSuggestions(query) {
                fetch('search.php?query=' + encodeURIComponent(query))
                    .then(response => response.text())
                    .then(data => {
                        if (data.trim() === '') {
                            suggestionsBox.style.display = 'none';
                        } else {
                            suggestionsBox.innerHTML = data;
                            suggestionsBox.style.display = 'block';
                            suggestionsBox.style.left = searchInput.getBoundingClientRect().left + 'px';
                            suggestionsBox.style.top = (searchInput.getBoundingClientRect().bottom + window.scrollY) + 'px';

                            document.querySelectorAll('.suggestion-item').forEach(item => {
                                item.addEventListener('click', function() {
                                    searchInput.value = this.innerText; 
                                    suggestionsBox.style.display = 'none'; 
                                    performSearch(this.innerText); 
                                });
                            });
                        }
                    })
                    .catch(error => console.error('Greška pri učitavanju predloga:', error));
            }

            searchInput.addEventListener('input', function() {
                const query = this.value;
                if (query.length > 0) {
                    showSuggestions(query); 
                } else {
                    suggestionsBox.style.display = 'none'; 
                }
            });

            function performSearch(query) {

                window.location.href = '?search=' + encodeURIComponent(query); 
            }

            document.addEventListener('click', function(e) {
                if (e.target !== searchInput && !suggestionsBox.contains(e.target)) {
                    suggestionsBox.style.display = 'none';
                }
            });
        });