import os
import subprocess
import sys

def run_command(command):
    try:
        # Using shell=True for windows compatibility and ease of use with complex commands
        result = subprocess.run(command, check=True, text=True, shell=True, capture_output=True)
        if result.stdout:
            print(result.stdout.strip())
        return True
    except subprocess.CalledProcessError as e:
        print(f"Error executing command: {e}")
        if e.stderr:
            print(e.stderr.strip())
        return False

def get_changed_files():
    # Get modified, deleted, and untracked files
    try:
        result = subprocess.run(['git', 'status', '--porcelain'], capture_output=True, text=True, check=True)
        lines = result.stdout.splitlines()
        files = []
        for line in lines:
            if line.strip():
                # Extract filename - porcelain format prefix is 2 chars + space
                # Format is "XY path" or "XY path -> newpath"
                # We want the 'path' part (or 'newpath' for renames)
                status = line[:2]
                path = line[3:]
                
                if '->' in path:
                    path = path.split('->')[-1].strip()
                
                files.append(path)
        return files
    except Exception as e:
        print(f"Error getting changed files: {e}")
        return []

def main():
    # Check if there's a custom prefix for commit messages
    custom_message = ""
    if len(sys.argv) > 1:
        custom_message = " ".join(sys.argv[1:]) + ": "

    files = get_changed_files()
    
    # Filter out git.py itself to commit it last or skip if no changes
    git_py_changed = False
    files_to_commit = []
    for f in files:
        if f == 'git.py':
            git_py_changed = True
        elif f == 'get_git_files.py': # Cleanup safe guard
            continue
        else:
            files_to_commit.append(f)

    if not files_to_commit and not git_py_changed:
        print("No changes detected.")
        return

    print(f"Found {len(files_to_commit) + (1 if git_py_changed else 0)} items to process.")

    for file_path in files_to_commit:
        print(f"\n--- Processing: {file_path} ---")
        if run_command(f'git add "{file_path}"'):
            filename = os.path.basename(file_path)
            commit_msg = f"{custom_message}Update {filename}"
            if run_command(f'git commit -m "{commit_msg}"'):
                print(f"Committed {file_path}")
            else:
                print(f"Failed to commit {file_path}")
        else:
            print(f"Failed to add {file_path}")

    # Finally commit git.py if it changed
    if git_py_changed:
        print(f"\n--- Processing: git.py ---")
        if run_command('git add "git.py"'):
            commit_msg = f"{custom_message}Update git script"
            if run_command(f'git commit -m "{commit_msg}"'):
                print(f"Committed git.py")

    print("\nPushing to remote...")
    if run_command("git push"):
        print("\nSuccessfully pushed all changes to GitHub!")
    else:
        print("\nPush failed. Check your connection or remote status.")

if __name__ == "__main__":
    main()
