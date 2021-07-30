function isMobile() {
  if (window.innerHeight > window.innerWidth) {
    return true;
  } else {
    return false;
  }
}

export { isMobile };
