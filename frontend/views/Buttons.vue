<template>
  <div class="btncontainer">
    <div class="resetfilters">
      <a href="">
        <div class="btncontent">
          <img
            src="../assets/filterson.svg"
            class="icon"
            alt="filtersoniccon"
          />
          <p>Zresetuj filtry</p>
        </div>
      </a>
    </div>
    <div class="saveasfile">
      <a href="">
        <div class="btncontent">
          <img
            src="../assets/downloadasfile.svg"
            class="icon"
            alt="downloadasfile"
          />
          <p>Zapisz do pliku</p>
        </div></a
      >
    </div>
  </div>
</template>

<style>
.btncontainer {
  display: flex;
  flex-direction: row;
  /* flex-grow: initial; */
  align-items: stretch;
}
.resetfilters {
  background: #4f46e5;
  width: 100%;
  /* padding: 15px 30px; */
  max-height: 55px;
}
.saveasfile {
  background: #908dd3;
  width: 100%;
  /* padding: 15px 30px; */
  max-height: 55px;
}
.resetfilters div p,
.saveasfile div p {
  color: white;
  font-size: 14px;
  text-align: center;
}
.btncontent {
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  padding: 10px 20px;
}
.btncontent > p {
  margin-left: 20px;
}
.icon {
  height: 35px;
}
</style>
