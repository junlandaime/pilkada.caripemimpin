import './bootstrap';
// Import dependencies
import Alpine from 'alpinejs'

// Initialize Alpine.js
window.Alpine = Alpine
Alpine.start()

// Candidate modal functionality
function candidateModal() {
    return {
        isOpen: false,
        candidateData: null,
        openModal(candidateId) {
            fetch(`/candidates/${candidateId}/short-info`)
                .then(response => response.json())
                .then(data => {
                    this.candidateData = data;
                    this.isOpen = true;
                })
                .catch(error => console.error('Error:', error));
        },
        closeModal() {
            this.isOpen = false;
            this.candidateData = null;
        }
    }
}

// Search functionality
// const searchForm = document.getElementById('search-form');
// const searchInput = document.getElementById('search-input');
// const searchResults = document.getElementById('search-results');

// if (searchForm) {
//     searchForm.addEventListener('submit', function(e) {
//         e.preventDefault();
//         const query = searchInput.value;
//         fetch(`/search?query=${encodeURIComponent(query)}`)
//             .then(response => response.text())
//             .then(html => {
//                 searchResults.innerHTML = html;
//             })
//             .catch(error => console.error('Error:', error));
//     });
// }

// Region filter functionality
const regionFilter = document.getElementById('region-filter');
if (regionFilter) {
    regionFilter.addEventListener('change', function() {
        const selectedRegion = this.value;
        window.location.href = `/candidates?region=${encodeURIComponent(selectedRegion)}`;
    });
}

// Infinite scroll for candidate list
let page = 1;
const candidateList = document.getElementById('candidate-list');
// const loadMoreTrigger = document.getElementById('load-more-trigger');

function loadMoreCandidates() {
    page++;
    fetch(`/candidates?page=${page}`)
        .then(response => response.text())
        .then(html => {
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = html;
            const newCandidates = tempDiv.querySelectorAll('.candidate-card');
            newCandidates.forEach(candidate => {
                candidateList.appendChild(candidate);
            });
        })
        .catch(error => console.error('Error:', error));
}

if (loadMoreTrigger) {
    const observer = new IntersectionObserver((entries) => {
        if (entries[0].isIntersecting) {
            loadMoreCandidates();
        }
    });
    observer.observe(loadMoreTrigger);
}

// Add smooth scrolling to all links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// Enable tooltips
const tooltips = document.querySelectorAll('[data-tooltip]');
tooltips.forEach(tooltip => {
    tooltip.addEventListener('mouseover', () => {
        const tooltipText = tooltip.getAttribute('data-tooltip');
        const tooltipEl = document.createElement('div');
        tooltipEl.classList.add('tooltip');
        tooltipEl.textContent = tooltipText;
        document.body.appendChild(tooltipEl);
        
        const rect = tooltip.getBoundingClientRect();
        tooltipEl.style.top = `${rect.bottom + window.scrollY}px`;
        tooltipEl.style.left = `${rect.left + window.scrollX}px`;
    });
    
    tooltip.addEventListener('mouseout', () => {
        const tooltipEl = document.querySelector('.tooltip');
        if (tooltipEl) tooltipEl.remove();
    });
});