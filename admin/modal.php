<style type="text/css">
	.modal {
	  display: none; /* Hidden by default */
	  position: fixed; /* Stay in place */
	  z-index: 1; /* Sit on top */
	  left: 0;
	  top: 0;
	  width: 100%; /* Full width */
	  height: 100%; /* Full height */
	  overflow: auto; /* Enable scroll if needed */
	  background-color: rgb(0,0,0); /* Fallback color */
	  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
	}

	/* Modal Content/Box */
	.modal-content {
	  background-color: #fefefe;
	  margin: 15% auto; /* 15% from the top and centered */
	  border: 1px solid #888;
	  width: 80%; /* Could be more or less, depending on screen size */
	  max-width: 540px;
	  text-align: center;
	}
	.modal-header{height: 30px;background-color: #d6232e;position: relative;}
	.modal-body{height: auto;padding:20px 0;}

	/* The Close Button */
	.closeModal {
		position: absolute;top:0;right:5px;
	  color: #000;
	  font-size: 28px;
	  font-weight: bold;
	}

	.closeModal:hover,
	.closeModal:focus {
	  color: black;
	  text-decoration: none;
	  cursor: pointer;
	}

	.lds-dual-ring {
	  display: inline-block;
	  width: 50px;
	  height: 50px;
	}
	.lds-dual-ring:after {
	  content: " ";
	  display: block;
	  width: 46px;
	  height: 46px;
	  margin: 1px;
	  border-radius: 50%;
	  border: 5px solid #d6282f;
	  border-color: #d6282f transparent #d6282f transparent;
	  animation: lds-dual-ring 1.2s linear infinite;
	}
	@keyframes lds-dual-ring {
	  0% {
	    transform: rotate(0deg);
	  }
	  100% {
	    transform: rotate(360deg);
	  }
	}


</style>
<div class="modal" id="modal">
	<div class="modal-content">
    	<div class="modal-header">
			<!-- <span class="closeModal">&times;</span> -->
			<span class="closeModal"></span>
		</div>
		<div class="modal-body">
			<div class="lds-dual-ring" id="loading"></div>
			<p id="modalResponse"></p>
		</div>
	</div>
</div>
<script type="text/javascript">
		const modal = document.getElementById("modal");
    const closeModal = document.getElementsByClassName("closeModal")[0];
    // When the user clicks on <span> (x), close the modal
    openModalFunction = () =>{ modal.style.display = "block"; }
    closeModalFunction = () =>{ modal.style.display = "none"; }
    closeModal.onclick = closeModalFunction();
    window.onclick = function(event) {
      if (event.target === modal) {
        closeModalFunction();
      }
    }
    modalHideLoading = () =>{document.getElementById('loading').style.display = "none";}
    modalSetMessage = (message) =>{ 
    	const letrero = document.getElementById('modalResponse');
    	letrero.innerHTML = message;
    	setTimeout(function(){
    		letrero.innerHTML = ''
    	},5000);
    }
</script>