class customefileupload{
		
	constructor(){
	 this.allowimagetype ="jpg,jpeg,png,";
	 this.allowotherfiles ="zip,xls,rar,pdf,xlsx,psd,";
	 this.allowalltypesfiles = this.allowimagetype + this.allowotherfiles;
	 this.imagefilesize = 52428800; //50 Mbs
	 this.otherfilesize = 1073741824;   //1 Gbs
	}
	 // allowimagetype, allowotherfiles,allowalltypesfiles,imagefilesize,otherfilesize;
	 
	/** Function for get files need to upload */
	getfilecart()
	{
		let uploadfilescart = [];
	
		if (localStorage.getItem('uploadfilescart')) {
			uploadfilescart = JSON.parse(localStorage.getItem('uploadfilescart'));
		}
		else
		{
			uploadfilescart = {"totalfiles":0,"totalfolder":0,"folders":[]};
			localStorage.setItem('uploadfilescart', JSON.stringify(uploadfilescart));
		}

		return uploadfilescart;
	}

	/** function for add files and its folder */
	 addfolder(foldername) {
        
        let filecart = this.getfilecart();
        let folders = filecart.folders ||[];

        let prindex = this.checkFolderexist(folders, foldername);
        if (prindex < 0) {
		  folders.push(foldername);
          filecart.folders = folders;
          localStorage.setItem('uploadfilescart', JSON.stringify(filecart));
        }
	  }

	  addordernumber(newordernumber,curfoldername) {
        
        let filecart = this.getfilecart();
		let folders = filecart.folders ||[];
		
		for (var i = 0; i < folders.length; i++) {
			if (folders[i].foldername == curfoldername && (folders[i].ordernumber== undefined || folders[i].ordernumber == '')) {
				folders[i].ordernumber =newordernumber;
				break;
			}
		}

		filecart.folders = folders;
		localStorage.setItem('uploadfilescart', JSON.stringify(filecart));
	  }

	  addfiles(filepath,filename) {
        
        let filecart = this.getfilecart();
        let folders = filecart.folders ||[];
		let foldername = this.getfoldername(filepath);
		let prindex = this.checkFolderexist(folders, foldername);
		
        if (prindex < 0) {

			var newfile =[];
			newfile.push(filepath);
			var newfolder = {"foldername":foldername,"files":newfile};
		  folders.push(newfolder);
		  filecart.folders = folders;
		  //console.log(filecart);
          localStorage.setItem('uploadfilescart', JSON.stringify(filecart));
		}
		else
		{
			//get perticular folders files
			 let folderarr = folders[prindex];
			
			//check file already exit or not
			//console.log(filename);
			let indexfile = this.checkduplicatefile(folderarr.files,filename);
			
			// if file not exit then add files
			if(indexfile < 0)
			{
				let newfilearr = folderarr.files;
				newfilearr.push(filepath);
				folderarr.files =newfilearr;
			}
			 
			 folders[prindex] = folderarr;
			 filecart.folders = folders;
			localStorage.setItem('uploadfilescart', JSON.stringify(filecart));
		}

		this.totalfilecount();
		this.totalfoldercount();
	  }


	  removefiles(filepath) {
        
        let filecart = this.getfilecart();
		let folders = filecart.folders ||[];
		let foldername = this.getfoldername(filepath);
		let prindex = this.checkFolderexist(folders, foldername);
		
        if (prindex || prindex==0) {
			
			//get perticular folders files
			 var newfolderarr = folders[prindex];
			// console.log(newfolderarr);
			if(newfolderarr)
			{
				let newfilearr = newfolderarr.files ||[];

				if(newfilearr.length)
				{
				
					for(var p=0;p < newfilearr.length;p++)
					{
						
						var compval = newfilearr[p].localeCompare(filepath);
						if(compval==0)
						{ 
							newfilearr.splice(p,1);
						}
					
					}
				}
				
				newfolderarr.files =newfilearr;
				
			}
			 
			 folders[prindex] = newfolderarr;
			 filecart.folders = folders;
			localStorage.setItem('uploadfilescart', JSON.stringify(filecart));
		}

	  }

	  getfoldername(filepath)
	  {
		 
		  let foldername ='';
		if (filepath.length > 2) {
			var dirs = filepath.split('/'); 
			foldername = dirs[dirs.length - 2];
		} 
		return foldername;
	  }

	  checkduplicatefile(arrfiles,newfile)
	  {
		let fileindex =-1;
		arrfiles = arrfiles || [];
		for (var i = 0; i < arrfiles.length; i++) {
			
			if (arrfiles[i].indexOf(newfile) >0) {
				fileindex = i;
				break;
			}
		}
		return fileindex;
	  }
	  
	  /** Function for check folder already exist or not */
	checkFolderexist(arrFolders, key) {
		let prindex =-1;
		arrFolders = arrFolders || [];
		for (var i = 0; i < arrFolders.length; i++) {
			//console.log(arrFolders[i].foldername+'-- '+key);
			if (arrFolders[i].foldername == key) {
				prindex = i;
				break;
			}
		}
		return prindex;
	}

	totalfilecount() {
		let totalcount = 0;
		let filecart = this.getfilecart();
        let folders = filecart.folders ||[];
		for (var i = 0; i < folders.length; i++) {
			if (folders[i].files.length) {
				totalcount = totalcount + folders[i].files.length;
			}
		}
		filecart.totalfiles = totalcount;
		localStorage.setItem('uploadfilescart', JSON.stringify(filecart));
	}

	totalfoldercount() {
		let totalfolder = 0;
		let filecart = this.getfilecart();
        let folders = filecart.folders ||[];
		totalfolder =folders.length;
		filecart.totalfolder = totalfolder;
		localStorage.setItem('uploadfilescart', JSON.stringify(filecart));
	}

	// function for check file extension
	checkallowfilestypes(currentfile)
	{
		var fileTypes =this.allowalltypesfiles;
		
		// get file extension 
		var file_ext = currentfile.name.substring(currentfile.name.lastIndexOf('.')+1, currentfile.name.length) || currentfile.name;
		
		var extindex= fileTypes.indexOf(file_ext); // check it is allow or not
		return extindex;
	}

	checkallowImages(currentfile)
	{
		var fileTypes =this.allowimagetype;
		// get file extension 
		var file_ext = currentfile.name.substring(currentfile.name.lastIndexOf('.')+1, currentfile.name.length) || currentfile.name;
		var extindex= fileTypes.indexOf(file_ext); // check it is allow or not
		return extindex;
	}

	checkfilesize(currentfile)
	{
		let sizeindex =-1;
		let imagefilesize = this.imagefilesize; //50 Mbs
		let otherfilesize = this.otherfilesize;   //1 Gbs
		var imagetype = this.allowimagetype;
		var othertype = this.allowotherfiles;
		var file_ext = currentfile.name.substring(currentfile.name.lastIndexOf('.')+1, currentfile.name.length) || currentfile.name;
		var isimage= imagetype.indexOf(file_ext);
		var isallowtype= othertype.indexOf(file_ext);
		//console.log(imagetype);
		if(isimage)
		{
			if(currentfile.size < imagefilesize)
			{
				sizeindex =1;
			}
		}
		else if(isallowtype)
		{
			if(currentfile.size < otherfilesize)
			{
				sizeindex =1;
			}
				
		}

		return sizeindex;

	}

	getcurrentfile(arrfileobj,indexfile)
	{
		var fileList = arrfileobj || []; 
		
		var currentfile;
		
		for (var l = 0; l < fileList.length; l++) {
			var filepath = fileList[l].webkitRelativePath;
		
			if(!filepath)
			{ 
				filepath = fileList[l].name;
			}
			var compval = filepath.localeCompare(indexfile);
			if(compval==0)
			{ 
				//console.log(filepath+' iiin =='+indexfile);

				currentfile = fileList[l];
				break;
			}
			
		}
		return currentfile;

	}

	/** function for clear folders */
	clearCart()
	{
		var uploadfilescart = {"totalfiles":"","totalfolder":"","folders":[]};
		localStorage.setItem('uploadfilescart', JSON.stringify(uploadfilescart));
	}

	removeuploadedfile(arrfileobj,indexfile)
	{
		var fileList = arrfileobj; 
		//console.log(arrfileobj);
		//console.log(uploadedfile);
		
		// {
		// 	for (i = 0; i < fileList.length; i++) {
				
		// 		if(fileList[i].name ==uploadedfile)
		// 		{ console.log("ddd-->"+i);
		// 			//fileList.splice(i,1);
		// 			break;
		// 		}
		// 	}
		// }
		
		return fileList;

	}
	

	checkallfilesfolder(currentfile,allfolderobject)
	{
// 		console.log(allfolderobject);
//  console.log("ssss--");
		var foldername = this.getfoldername(currentfile.webkitRelativePath);
		console.log(foldername);
		
		
		var foldersize = this.getFoldersize(allfolderobject);
		
		if(foldersize)
		{
			var isfolderexist = this.getFolderexist(foldername,allfolderobject);
			if(isfolderexist)
			{
				console.log(' dddd have size'+isfolderexist);
			}
			else
			{
				allfolderobject.foldername = foldername;
				allfolderobject.files = currentfile;
			}
			
		}
		else{

			allfolderobject.foldername = foldername;
			allfolderobject.files = currentfile;
		}
		
		
		return allfolderobject;
	}

	getFolderexist(foldername,allfolderobject)
	{
		
		var folderexist=0;

		for (var key in allfolderobject) 
			{  //console.log("nnn"+allfolderobject.foldername );
				if (allfolderobject.foldername ==foldername)
				{ 
					folderexist++;
				} 
			}
		

		return folderexist;
	}

	// get folder object size
	getFoldersize(allfolderobject)
	{
		
		var foldersize=0;
		for (var key in allfolderobject) 
			{ 
				if (allfolderobject.hasOwnProperty('foldername') && key=='foldername')
				{ 
					foldersize++;
				} 
			}
		

		return foldersize;
	}

	
}