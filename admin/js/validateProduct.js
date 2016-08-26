function validateForm() {
		
	var productNum = document.forms["product_form"]["product_number"].value;
	var vendorName = document.forms["product_form"]["fkvendor_id"].value;
	var productCat = document.forms["product_form"]["category_id"].value;
	var productSubCat = document.forms["product_form"]["fk_subcategory_id"].value;
	var productName = document.forms["product_form"]["product_name"].value;
	var prodpriceDouble = document.forms["product_form"]["base_price"].value;
	var prodColours = document.forms["product_form"]["colours"].value;
	var prodSize = document.forms["product_form"]["sizes"].value;
	var productDescription = document.forms["product_form"]["description"].value;
//	var vendorAddress = document.forms["register_form"]["vend_address"].value;
//	var vendorCity = document.forms["register_form"]["vend_city"].value;
//	var vendorProv = document.forms["register_form"]["vend_province"].value;
//	var vendor_postal_code = document.forms["register_form"]["vend_postal_code"].value;
//	var vendor_phone_number = document.forms["register_form"]["vend_phone_number"].value;
//	var vendor_email = document.forms["register_form"]["vend_email"].value;

	var regex1 = /^[0-9]+$/;
	var regex2 = /^\d{2}\.\d{2}$/; 
    //var regex3 = /^[0-9a-zA-Z]+$/;
//	var regex4 = /^[ABCEGHJKLMNPRSTVXY]{1}\d{1}[A-Z]{1} *\d{1}[A-Z]{1}\d{1}$/;
//	var regex5 = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
//	var regex6 = /^[2-9]\d{2}-\d{3}-\d{4}$/;

			
	// Vendor Name
	if(productNum == null || productNum == "")
	{
		alert("Product number must be filled in.");
		return false;
	}

	
	if(!productNum.match(regex1))
	{
		alert("Invalid product number.");
		return false;
	}

	// Dropdown Vendor Name
	if(vendorName ==  0)
	{
	alert("Please choose a Vendor");
	return false;
	}

	// Dropdown Category
			
	if(productCat ==  0)
	{
		alert("Please choose a Category");
		return false;
	}
	
	// Dropdown Sub Category
	if(productSubCat ==  0)
	{
		alert("Please choose a Sub Category");
		return false;
	}

	// Product Name
	if(productName == null || productName == "")
	{
		alert("Product name must be filled in.");
		return false;
	}

	
	if(productName.match(regex1))
	{
		alert("Invalid product name.");
		return false;
	}

	// Product Price
	if(prodpriceDouble == null || prodpriceDouble == "")
	{
		alert("Price must be filled in.");
		return false;
	}

	
	if(prodpriceDouble.match(regex1))
	{
		alert("Invalid price.");
		return false;
	}

	// Product Colours
	if(prodColours == null || prodColours == "")
	{
		alert("Colour must be filled in.");
		return false;
	}

	
	if(prodColours.match(regex1))
	{
		alert("Invalid colour.");
		return false;
	}

	// Product Size
	if(prodSize == null || prodSize == "")
	{
		alert("Size must be filled in.");
		return false;
	}

	
	if(prodSize.match(regex1))
	{
		alert("Invalid size.");
		return false;
	}

	// Description
	if(productDescription == null || productDescription == "")
	{
		alert("Size must be filled in.");
		return false;
	}

	// Category
	if(productCategory == null || productCategory == "")
	{
		alert("Category must be filled out.");
		return false;
	}

	
		
	//Address
//	if(vendorAddress == null || vendorAddress == "" || vendorAddress == "ex. 1234 Blue Leaf")
//	{
//		alert("Address must be filled out.");
//		return false;
//	}
//	
//	if(!vendorAddress.match(regex2))
//	{
//		alert("Invalid Address.");
//		return false;
//	}
		
	//City
//	if(vendorCity == null || vendorCity == "")
//	{
//		alert("City must be filled out.");
//		return false;
//	}
//	
//	if(!vendorCity.match(regex1))
//	{
//		alert("Invalid Vendor name must be letters and no spaces.");
//		return false;
//	}
//
//	//Province
//
//	if(vendorProv ==  0)
//	{
//		alert("Please choose a province");
//		return false;
//	}
//	
//	//Postal Code
//	if(vendor_postal_code == null || vendor_postal_code == "")
//	{
//		alert("Postal Code must be filled out.");
//		return false;
//	}
//	
//		
//	if(! vendor_postal_code.match(regex4))
//	{
//		alert("Invalid Postal Code.");
//		return false;
//	}
//		
//	//Phone Number
//	if(vendor_phone_number == null || vendor_phone_number == "" || vendor_phone_number == "ex. 905-123-4567")
//	{
//		alert("Phone Number must be filled out.");
//		return false;
//	}
//	
//	if(! vendor_phone_number.match(regex6))
//	{
//		alert("Invalid Phone Number.");
//		return false;
//	}
//
//	//email
//
//	if(vendor_email == null || vendor_email == "")
//	{
//		alert("Email must be filled out.");
//		return false;
//	}
//
//	if(! vendor_email.match(regex5))
//	{
//		alert("Invalid email address.");
//		return false;
//	}
	


}