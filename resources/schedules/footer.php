</div>
<footer id="main-footer" class="py-3 text-center">
    Copyright &copy;
    <span class="year"></span> Ethio-Cinemas
  </footer>

  <script type='text/javascript' src='../js/jquery-3.3.1.min.js'></script>
  <script type='text/javascript' src='../js/index.js'></script>
  <script type='text/javascript' src='../js/bootstrap.min.js'></script>
  <script>
  function flipModal(id){
    document.getElementById('seat_id').value=id;
    $('#reserveModal').modal('toggle');
  }
const White_bg_btns = document.getElementsByClassName("btn-primary");
for(let i=0;i<White_bg_btns.length;i++){
  White_bg_btns[i].disabled=true;
}
</script>
</body>
</html>