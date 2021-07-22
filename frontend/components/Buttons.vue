<template>
  <div class="btncontainer">
    <button class="resetfilters" href="www.the100clth.pl">
      <i class="far fa-eye"></i>
      Zresetuj filtry
    </button>
    <button class="saveasfile" href="www.the100clth.pl">
      <i class="fas fa-cloud-download-alt"></i>
      Zapisz do pliku
    </button>
  </div>
</template>

<style>
.btncontainer {
  display: flex;
  flex-direction: row;
  align-items: stretch;
}

.resetfilters,
.saveasfile {
  height: 50px;
  width: 100%;
  display: block;
  font-size: 16px;
  color: white;
}

.resetfilters {
  background: #4f46e5;
}

.saveasfile {
  background: #8da0d3;
}

.resetfilters > *,
.saveasfile > * {
  color: white;
}

.resetfilters > i,
.saveasfile > i {
  padding-right: 15px;
}
</style>
