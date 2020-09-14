<template>
  <div>
      <div class="modal fade" id="ders-detay" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <!--Header-->
                  <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel">Ders Detay</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                  </div>
                  <!--Body-->
                  <div class="modal-body">
                      <p>
                          <strong>Ders Kodu</strong>
                      </p>
                      <span>{{  ders.kod }}</span>
                      <hr>
                     <p>
                        <strong>Ders Adı</strong>
                     </p>
                      <span>{{  ders.adi }}</span>
                      <hr>
                      <p>
                          <strong>Ders Kredi</strong>
                      </p>
                      <span>{{  ders.kredi }}</span>

                  </div>
                  <!--Footer-->
                  <div class="modal-footer">
                      <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Kapat</button>
                  </div>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
export default {
    name: "DersDetay",
    props:['ders']
}
</script>

<style scoped>

</style>
