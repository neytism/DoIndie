<input type="text" placeholder="Search..." oninput="inputSearch(this,'<?php echo BASEURL; ?>')">

<div id="search-container" style="background-color: gray; display: none;" >
    
    <div id="loading" style="display: none;">Loading...</div>
    <div id="no-result" style="display: none;">No Result.</div>
    
    <div id="results" style="display: none;">
    
    </div>

</div>

<script type="text/javascript" src="<?php echo BASEURL; ?>assets/js/search.js"></script>