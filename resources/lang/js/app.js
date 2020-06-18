require('./bootstrap');

window.Vue = require('vue');
const moment = require('moment');


const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


const app = new Vue({
    el: '#app',
});

const land = new Vue({
    el: '#land',
});


const searchForm = document.querySelector('.landing-search');
const searchInput = document.querySelector('#land-search-input');
const searchBtn = document.querySelector('#land-search-btn');
const landSearchResult = document.querySelector('.land-search-result');


searchForm.addEventListener('submit', function (e) {
    e.preventDefault();
});


function searchBtnAnimationStart(e) {
    gsap.to(searchBtn, {
        duration: 0.2,
        display: 'block',
        width: '40px'
    })
}

function searchBtnAnimationEnd(e) {
    gsap.to(searchBtn, {
        duration: 0.001,
        display: 'none',
        width: '0px'
    })
}

function removeSearchoutput() {
    landSearchResult.classList.add('d-none');
}

searchInput.addEventListener('focus', searchBtnAnimationStart);
searchBtn.addEventListener('click', searchBtnAnimationEnd);
searchBtn.addEventListener('click', removeSearchoutput);


// AJAX TYPED SEARCH
const q = document.querySelector(".q");
const r = document.querySelector(".r");

const url = `https://movie.planetnine.com/api/shows`;
const shows = [];

console.log(shows);


fetch(url)
    .then((blob) => blob.json())
    .then((data) => shows.push(...data));

function findMatches(wordToMatch, shows) {
    return shows.filter((show) => {
        const regex = new RegExp(wordToMatch, "gi");
        return show.city.match(regex);
    });
}

function displayMatches() {
    landSearchResult.classList.remove('d-none');
    const matchArr = findMatches(this.value, shows);
    const html = matchArr
        .map((value) => {
            return `
                <div class="single-search-box">

                <div class="">
                <div class="" id="heading-${value.id}">
                  <h2 class="mb-0">
                    <button type="button" data-toggle="collapse" data-target="#collapse${value.id}" aria-expanded="true" aria-controls="collapse${value.id}">
                    <div class="ls-box">
                    <i class="fa fa-file-video-o fa-2x"></i>
                    <div>
                        <h3>${value.city}</h3>
                        <p>${value.name}</p>
                    </div>
                    <p class="ls-at">${moment(value.date).format('MMMM Do')} ${moment(value.time, 'HH:mm').format('HH:mm')}</p>
                </div>
                    </button>
                  </h2>
                </div>
            
                <div id="collapse${value.id}" class="collapse" aria-labelledby="heading-${value.id}" data-parent="#accordionSearch">
                <div class="buy-ticket">
                <h3>${value.movie_title}</h3>
                <a target="_blank" href="${value.ticket_url}"><i class="fa fa-ticket"></i> GET TICKETS</a>
            </div>
                </div>
              </div>      
    `;
        })
        .join("");
    r.innerHTML = html;
}

q.addEventListener("change", displayMatches);
q.addEventListener("keyup", displayMatches);
