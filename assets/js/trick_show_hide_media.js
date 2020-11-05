let media = document.getElementById('media');
let showMediaButton = document.getElementById('show_media');
let hideMediaButton = document.getElementById('hide_media');

function getDeviceType() {
  const ua = navigator.userAgent;
  if (/(tablet|ipad|playbook|silk)|(android(?!.*mobi))/i.test(ua)) {
    return "tablet";
  }
  if (
    /Mobile|iP(hone|od|ad)|Android|BlackBerry|IEMobile|Kindle|Silk-Accelerated|(hpw|web)OS|Opera M(obi|ini)/.test(
      ua
    )
  ) {
    return "mobile";
  }
  return "desktop";
};

device = getDeviceType()

if (device === 'desktop') {
    showMediaButton.style.display = "none";
    hideMediaButton.style.display = "none";
} else {
    hideMediaButton.style.display = "none";
    media.style.display = "none";
}

hideMediaButton.addEventListener('click', function (event)
{
    showMediaButton.style.display = "block";
    media.style.display = "none";
    hideMediaButton.style.display = "none";
});

showMediaButton.addEventListener('click', function (event)
{
    hideMediaButton.style.display = "block";
    media.style.display = "block";
    showMediaButton.style.display = "none";
});
