const fetchData = async (url) => {
  const response = await fetch(url);
  return response.json();
};

export { fetchData };
