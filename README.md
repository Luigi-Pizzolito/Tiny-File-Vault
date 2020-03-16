# Tiny File Vault
 A tiny PHP based system for storing and accessing AES-256 encrypted files on-the-fly

# Features
- V1
    - Upload files and encrypt on the fly
    - Link scheme
    - Auto generated file names and keys, preserve file types
    - Decrypt files and access on the fly
    - V1.1
        - Never store decrypted file
        - Discard all variables from RAM
        - No user inpout for PHP injection
    - V1.2
        - [ ] file size check
        - [ ] send extra file info to browser in custom headers

- V2
    - [ ] make nice barebones GUI (early 2000s style)
		- [ ] progress bar when uploading
		- [ ] progress bar when downloading/viewing (use blobs)
        - [ ] Add prompt for password if not in link
        - [ ] show basic file info

- V3
    - [ ] login system (w/ Cookies, Local Storage or Session)
        - [ ] temp. cookie login or DB
        - [ ] file listing
        - [ ] file deletion
        - [ ] file name re-assign (rename url to remove past access/link)
        - [ ] offline storage option? JS AES sounds like a bad idea…???
		- [ ] Add flexible admin config file (JSON?)