export default {
  fetch(router, endpoint, callback) {
    return fetch("/api/" + endpoint + ".json?" + Date.now())
      .then((response) => response.json())
      .then((data) => {
        callback(data);
      })
      .catch(() => {
        router.push({ name: "404" });
      });
  },
};
