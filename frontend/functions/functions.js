function isMobile() {
  return window.innerHeight > window.innerWidth;
}

const fetchData = async (url) => {
  const response = await fetch(url);
  return response.json();
};

export { isMobile, fetchData };
